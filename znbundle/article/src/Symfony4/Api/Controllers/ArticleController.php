<?php

namespace Untek\Bundle\Article\Symfony4\Api\Controllers;

use Untek\Bundle\Article\Domain\Interfaces\PostServiceInterface;
use Untek\Lib\Rest\Symfony4\Base\BaseCrudApiController;

class ArticleController extends BaseCrudApiController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->service = $postService;
    }

}
