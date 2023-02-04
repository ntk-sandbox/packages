<?php

namespace Untek\Bundle\Article\Symfony4\Api;

use Doctrine\DBAL\Connection;
use Illuminate\Database\Capsule\Manager as CapsuleManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\Routing\RouteCollection;
use Untek\Bundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use Untek\Bundle\Article\Domain\Interfaces\PostRepositoryInterface;
use Untek\Bundle\Article\Domain\Interfaces\PostServiceInterface;
use Untek\Bundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use Untek\Bundle\Article\Domain\Interfaces\TagRepositoryInterface;
use Untek\Bundle\Article\Domain\Repositories\Doctrine\PostRepository;
use Untek\Bundle\Article\Domain\Repositories\Eloquent\CategoryRepository;
use Untek\Bundle\Article\Domain\Repositories\Eloquent\TagPostRepository;
use Untek\Bundle\Article\Domain\Repositories\Eloquent\TagRepository;
use Untek\Bundle\Article\Domain\Services\PostService;
use Untek\Bundle\Article\Symfony4\Api\Controllers\ArticleController;
use Untek\Database\Eloquent\Domain\Capsule\Manager;
use Untek\Lib\Db\Facades\DoctrineFacade;
use Untek\Lib\Rest\Helpers\RestApiRouteHelper;

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
