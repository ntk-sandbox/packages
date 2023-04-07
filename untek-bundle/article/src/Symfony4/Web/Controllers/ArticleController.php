<?php

namespace Untek\Bundle\Article\Symfony4\Web\Controllers;

use Untek\Model\DataProvider\Entities\DataProviderEntity;
use Untek\Model\Query\Helpers\QueryHelper;
use Untek\Model\DataProvider\Libs\DataProvider;
use Untek\Model\Query\Entities\Query;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Lib\Rest\Web\Controller\BaseCrudWebController;
use Untek\Bundle\Article\Domain\Interfaces\PostServiceInterface;
use Untek\Bundle\Notify\Domain\Enums\FlashMessageTypeEnum;
use Untek\Bundle\Notify\Domain\Interfaces\Services\FlashServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Untek\Lib\Web\Controller\Helpers\WebQueryHelper;

class ArticleController extends AbstractController
{

    private $service;
    private $flashService;

    public function __construct(PostServiceInterface $postService, FlashServiceInterface $flashService)
    {
        $this->service = $postService;
        $this->flashService = $flashService;
    }

    public function index(Request $request): Response
    {
        $query = WebQueryHelper::getAllParams($request->query->all());
        $query->with('category');

        $page = $request->get("page", 1);
        $pageSize = $request->get("per-page", 10);
        $dataProvider = new DataProvider($this->service, $query, $page, $pageSize);

        return $this->render('@Article/post/index.html.twig', [
            'dataProviderEntity' => $dataProvider->getAll(),
        ]);
    }

    public function view($id, Request $request): Response
    {
        $query = new Query;
        $query->with('category');
        $entity = $this->service->findOneById($id, $query);
        return $this->render('@Article/post/view.html.twig', [
            'post' => $entity,
        ]);
    }

    public function create(Request $request): Response
    {
        return $this->render('@Article/post/create.html.twig');
    }

    public function update($id, Request $request): Response
    {
        $query = new Query;
        $query->with('category');
        $entity = $this->service->findOneById($id, $query);
        return $this->render('@Article/post/update.html.twig', [
            'post' => $entity,
        ]);
    }

    public function delete($id, Request $request): Response
    {
        $this->service->deleteById($id);
        $postListUrl = $this->generateUrl('web_article_post_index');
        $this->flashService->addSuccess('Post deleted!');
        return $this->redirect($postListUrl);
    }

}
