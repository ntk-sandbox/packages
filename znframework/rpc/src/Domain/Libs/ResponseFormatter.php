<?php

namespace ZnFramework\Rpc\Domain\Libs;

use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnCore\Env\Helpers\EnvHelper;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;

class ResponseFormatter
{

    public function forgeErrorResponse(int $code, string $message = null, $data = null, \Throwable $e = null): RpcResponseEntity
    {
        $error = [
            'code' => $code,
            'message' => $message,
            'data' => null,
        ];

        if (EnvHelper::isDebug()) {
            if (empty($data)) {
                $data = [];
            }
            if ($e instanceof \Throwable) {
                try {
                    $attributes = EntityHelper::toArray($e);
                    $data = ArrayHelper::merge($attributes, $data);
                } catch (NoSuchPropertyException $e) {
                }
                if ($e->getPrevious() instanceof \Throwable) {
                    try {
                        $data['previous'] = EntityHelper::toArray($e->getPrevious());
                    } catch (NoSuchPropertyException $e) {
                    }
                }
            }
        }

        $error['data'] = $data;
        $responseArray = [
            'error' => $error,
        ];

        $responseEntity = new RpcResponseEntity;
        PropertyHelper::setAttributes($responseEntity, $responseArray);
        return $responseEntity;
    }
}
