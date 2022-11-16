<?php

namespace ZnBundle\Article\Symfony4\Api;

use Doctrine\DBAL\Connection;
use Illuminate\Database\Capsule\Manager as CapsuleManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\Routing\RouteCollection;
use ZnBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\PostRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\PostServiceInterface;
use ZnBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\TagRepositoryInterface;
use ZnBundle\Article\Domain\Repositories\Doctrine\PostRepository;
use ZnBundle\Article\Domain\Repositories\Eloquent\CategoryRepository;
use ZnBundle\Article\Domain\Repositories\Eloquent\TagPostRepository;
use ZnBundle\Article\Domain\Repositories\Eloquent\TagRepository;
use ZnBundle\Article\Domain\Services\PostService;
use ZnBundle\Article\Symfony4\Api\Controllers\ArticleController;
use ZnDatabase\Eloquent\Domain\Capsule\Manager;
use ZnLib\Db\Facades\DoctrineFacade;
use ZnLib\Rest\Helpers\RestApiRouteHelper;

class ArticleModule
{

    public function getRouteCollection(RouteCollection $routeCollection)
    {
        RestApiRouteHelper::defineCrudRoutes('v1/article-post', ArticleController::class, $routeCollection);
    }

    public function bindContainer(ContainerInterface $container)
    {
        $container->bind(CapsuleManager::class, Manager::class);
        $container->bind(Connection::class, function () {
            return DoctrineFacade::createConnection();
        });
        $container->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $container->bind(TagRepositoryInterface::class, TagRepository::class, true);
        $container->bind(TagPostRepositoryInterface::class, TagPostRepository::class);
        $container->bind(PostRepositoryInterface::class, PostRepository::class);
        $container->bind(PostServiceInterface::class, PostService::class);
    }

}
