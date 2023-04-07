<?php

namespace Untek\Bundle\Messenger\Domain\Services;

use FOS\UserBundle\Model\FosUserInterface;
use GuzzleHttp\Client;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Untek\Bundle\Messenger\Domain\Entities\FlowEntity;
use Untek\Bundle\Messenger\Domain\Entities\MessageEntity;
use Untek\Bundle\Messenger\Domain\Forms\MessageForm;
use Untek\Bundle\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use Untek\Bundle\Messenger\Domain\Interfaces\FlowRepositoryInterface;
use Untek\Bundle\Messenger\Domain\Interfaces\Repositories\MessageRepositoryInterface;
use Untek\Bundle\Messenger\Domain\Interfaces\Services\MessageServiceInterface;
use Untek\Bundle\User\Domain\Services\AuthService;
use Untek\Bundle\User\Domain\Services\AuthService2;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\Validator\Helpers\ValidationHelper;
use Untek\Lib\Socket\Domain\Entities\SocketEventEntity;
use Untek\Lib\Socket\Domain\Libs\SocketDaemon;
use Untek\User\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;

class MessageService extends BaseCrudService implements MessageServiceInterface
{

    private $chatService;
    //private $security;
    private $flowRepository;
    private $botRepository;
    private $userRepository;
    private $chatRepository;
    private $botService;
    private $socketDaemon;
    private $identityRepository;

    public function __construct(
        EntityManagerInterface $em,
        MessageRepositoryInterface $repository,
        ChatRepositoryInterface $chatRepository,
        IdentityRepositoryInterface $identityRepository,
        SocketDaemon $socketDaemon,
        FlowRepositoryInterface $flowRepository,
        private Security $security
        //BotService $botService
    )
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
        $this->chatRepository = $chatRepository;
        $this->identityRepository = $identityRepository;
        $this->socketDaemon = $socketDaemon;
        $this->flowRepository = $flowRepository;
    }

    public function createEntity(array $attributes = []): MessageEntity
    {
        $entity = parent::createEntity($attributes);
        $user = $this->security->getUser();
        $entity->setAuthorId($user->getId());
        return $entity;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        return parent::forgeQuery($query)->with('author');
    }

    public function sendMessageByForm(MessageForm $messageForm)
    {
        ValidationHelper::validateEntity($messageForm);
        $identity = $this->security->getUser();
        $chatEntity = $this->chatRepository->findOneByIdWithMembers($messageForm->getChatId());
        $messageEntity = $this->createEntity();
        $messageEntity->setChatId($messageForm->getChatId());
        $messageEntity->setAuthorId($identity->getId());
        $messageEntity->setChat($chatEntity);
        $messageEntity->setText($messageForm->getText());
        $this->getRepository()->create($messageEntity);
        $this->getEntityManager()->loadEntityRelations($messageEntity, ['chat.members.user']);
        $this->sendFlow($messageEntity);
        return $messageEntity;
    }

    public function sendMessage(int $chatId, string $text)
    {
        $identity = $this->security->getUser();
        $chatEntity = $this->chatRepository->findOneByIdWithMembers($chatId);
        $messageEntity = $this->createEntity();
        $messageEntity->setChatId($chatId);
        $messageEntity->setAuthorId($identity->getId());
        $messageEntity->setChat($chatEntity);
        $messageEntity->setText($text);
        $this->getRepository()->create($messageEntity);
        $this->sendFlow($messageEntity);
        return $messageEntity;
    }

    public function sendMessageFromBot($botToken, array $request)
    {
        $botEntity = $this->botService->authByToken($botToken);
        $chatEntity = $this->chatService->repository->findOneByIdWithMembers($request['chat_id']);

        $messageEntity = new MessageEntity;
        $messageEntity->setAuthorId($botEntity->getUserId());
        $messageEntity->setChatId($chatEntity->getId());
        $messageEntity->setChat($chatEntity);
        $messageEntity->setText($request['text']);
        $this->getRepository()->create($messageEntity);

        $this->sendFlow($messageEntity);
        return $messageEntity;
    }

    private function sendFlow(MessageEntity $messageEntity)
    {
        $chatEntity = $messageEntity->getChat();
        $author = $this->identityRepository->findOneById($messageEntity->getAuthorId());
        $messageEntity->setAuthor($author);

        foreach ($chatEntity->getMembers() as $memberEntity) {
//            $roles = $memberEntity->getUser()->getRoles();
//            if (in_array('ROLE_BOT', $roles)) {
            if (1 == 2) {
                if ($messageEntity->getAuthorId() != $memberEntity->getUserId()) {
                    $this->sendMessageToBot($memberEntity->getUser(), $messageEntity);
                }
            } else {
                $flowEntity = new FlowEntity();
                $flowEntity->setChatId($chatEntity->getId());
                $flowEntity->setMessageId($messageEntity->getId());
                $flowEntity->setUserId($memberEntity->getUserId());
                $this->flowRepository->create($flowEntity);
            }


            $isMe = $memberEntity->getUserId() == $this->security->getUser()->getId();
            $event = new SocketEventEntity;
            $event->setUserId($memberEntity->getUserId());
            $event->setName('sendMessage');
            $event->setData(
                [
                    'direction' => $isMe ? 'out' : 'in',
                    'text' => $messageEntity->getText(),
                    'chatId' => $memberEntity->getChatId(),
                ]
            );
            $this->socketDaemon->sendMessageToTcp($event);
        }
    }

    public function sendMessageToBot(UserInterface $botIdentity, MessageEntity $messageEntity)
    {
        $data = [
            "update_id" => $messageEntity->getId(),
            "message" => [
                "message_id" => $messageEntity->getId(),
                "from" => [
                    "id" => $messageEntity->getAuthorId(),
                    "is_bot" => false,
                    "first_name" => $messageEntity->getAuthor()->getUsername(),
                    "username" => $messageEntity->getAuthor()->getUsername(),
                    "language_code" => "ru",
                ],
                "chat" => [
                    "id" => $messageEntity->getChatId(),
                    "first_name" => $messageEntity->getChat()->getTitle(),
                    "username" => $messageEntity->getChat()->getTitle(),
                    "type" => 'private',
                ],
                "date" => time(),
                "text" => $messageEntity->getText(),
            ]
        ];

        $botEntity = $this->botRepository->findOneByUserId($botIdentity->getId());
        $client = new Client(['base_uri' => $botEntity->getHookUrl()]);
        $response = $client->post(
            null,
            [
                'json' => $data,
            ]
        );
    }
}
