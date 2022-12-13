<?php

namespace ZnSandbox\Sandbox\RpcClient\Domain\Helpers;

use ZnFramework\Rpc\Domain\Entities\MethodEntity;
use ZnSandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity;
use ZnSandbox\Sandbox\RpcClient\Symfony4\Admin\Forms\RequestForm;

class FavoriteHelper
{

    public static function generateFavoriteCollectionToMap($collection)
    {
        $map = [];
        /** @var FavoriteEntity $favoriteEntityItem */
        foreach ($collection as $favoriteEntityItem) {
            $methodItems = explode('.', $favoriteEntityItem->getMethod());
            if(count($methodItems) > 1) {
                $groupName = $methodItems[0];
            } else {
                $groupName = 'other';
            }
            $map[$groupName][] = $favoriteEntityItem;
        }
        ksort($map);
        return $map;
    }

    public static function generateMethodCollectionToMap($collection)
    {
        $map = [];
        /** @var MethodEntity $favoriteEntityItem */
        foreach ($collection as $favoriteEntityItem) {
            $methodItems = explode('.', $favoriteEntityItem->getMethodName());
            if(count($methodItems) > 1) {
                $groupName = $methodItems[0];
            } else {
                $groupName = 'other';
            }
            $map[$groupName][] = $favoriteEntityItem;
        }
        ksort($map);
        return $map;
    }

    public static function formToEntity(RequestForm $requestForm, FavoriteEntity $favoriteEntity = null): FavoriteEntity
    {
        $favoriteEntity = $favoriteEntity ?: new FavoriteEntity();
        $favoriteEntity->setMethod($requestForm->getMethod());
        $favoriteEntity->setBody(json_decode($requestForm->getBody()));
        $favoriteEntity->setMeta(json_decode($requestForm->getMeta()));
        $favoriteEntity->setDescription($requestForm->getDescription());
        $favoriteEntity->setAuthBy($requestForm->getAuthBy() ?: null);
        $favoriteEntity->setVersion($requestForm->getVersion());
        return $favoriteEntity;
    }

    public static function entityToForm(FavoriteEntity $favoriteEntity, RequestForm $requestForm): RequestForm
    {
        $requestForm->setMethod($favoriteEntity->getMethod());
        $requestForm->setMeta(json_encode($favoriteEntity->getMeta()));
        $requestForm->setBody(json_encode($favoriteEntity->getBody()));
        $requestForm->setAuthBy($favoriteEntity->getAuthBy());
        $requestForm->setDescription($favoriteEntity->getDescription());
        $requestForm->setVersion($favoriteEntity->getVersion());
        return $requestForm;
    }
}