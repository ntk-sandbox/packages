<?php

namespace Untek\Framework\Rpc\Symfony4\HttpKernel;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Untek\Core\Env\Helpers\EnvHelper;
use Untek\Framework\Rpc\Domain\Libs\ResponseFormatter;
use Untek\Framework\Rpc\Symfony4\Libs\RpcRequestHandler;
use Untek\Component\Web\WebApp\Base\BaseHttpKernel;

class RpcKernel extends BaseHttpKernel
{

    protected $responseFormatter;
    protected $rpcRequestHandler;

    public function __construct(
        EventDispatcherInterface $dispatcher,
        ControllerResolverInterface $resolver,
        RpcRequestHandler $rpcRequestHandler,
        ResponseFormatter $responseFormatter,
        RequestStack $requestStack = null,
        ArgumentResolverInterface $argumentResolver = null
    )
    {
        parent::__construct($dispatcher, $resolver, $requestStack, $argumentResolver);
        $this->responseFormatter = $responseFormatter;
        $this->rpcRequestHandler = $rpcRequestHandler;
    }

    protected function handleRaw(Request $request, int $type = self::MAIN_REQUEST): Response
    {
        $this->requestStack->push($request);

        // request
        $event = new RequestEvent($this, $request, $type);
        $this->getEventDispatcher()->dispatch($event, KernelEvents::REQUEST);

        if ($event->hasResponse()) {
            return $this->filterResponse($event->getResponse(), $request, $type);
        }

        $jsonData = $request->getContent();
        $responseData = $this->rpcRequestHandler->handleJsonData($jsonData);
        $response = $this->createJsonResponse($responseData);
        $response = $this->filterResponse($response, $request, $type);
        return $response;
    }

    private function createJsonResponse(array $responseData): JsonResponse
    {
        $response = new JsonResponse();
        if (EnvHelper::isDebug()) {
            $response->setEncodingOptions(JSON_PRETTY_PRINT);
        }
        $response->setData($responseData);
        return $response;
    }
}
