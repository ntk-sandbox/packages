<?php

namespace ZnBundle\Article\Domain\Repositories\Relations;

use ZnBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\TagRepositoryInterface;
use ZnDomain\Domain\Enums\RelationEnum;
use ZnDomain\Domain\Libs\Relation\ManyToMany;
use ZnDomain\Domain\Libs\Relation\OneToOne;
use ZnDomain\Repository\Interfaces\RelationConfigInterface;

class PostRelation
{

    private $categoryRepository;
    private $tagPostRepository;
    private $tagRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, TagRepositoryInterface $tagRepository, TagPostRepositoryInterface $tagPostRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->tagPostRepository = $tagPostRepository;
        $this->tagRepository = $tagRepository;
    }

    public function primaryKey()
    {
        return ['id'];
    }

//    public function relations()
//    {
//        return [
//            'category' => [
//                /*'type' => RelationEnum::ONE,
//                'field' => 'categoryId',
//                'foreign' => [
//                    'model' => $this->categoryRepository,
//                    'field' => 'id',
//                ],*/
//                'type' => RelationEnum::CALLBACK,
//                'callback' => function (Enumerable $collection) {
//                    $m2m = new OneToOne;
//                    //$m2m->selfModel = $this;
//
//                    $m2m->foreignModel = $this->categoryRepository;
//                    $m2m->foreignField = 'categoryId';
//                    $m2m->foreignContainerField = 'category';
//
//                    $m2m->run($collection);
//                },
//            ],
//            'tags' => [
//                'type' => RelationEnum::CALLBACK,
//                'callback' => function (Enumerable $collection) {
//                    $m2m = new ManyToMany;
//                    $m2m->selfModel = $this;
//                    $m2m->selfField = 'postId';
//
//                    $m2m->viaModel = $this->tagPostRepository;
//
//                    $m2m->foreignModel = $this->tagRepository;
//                    $m2m->foreignField = 'tagId';
//                    $m2m->foreignContainerField = 'tags';
//
//                    $m2m->run($collection);
//                },
//            ],
//        ];
//    }

}