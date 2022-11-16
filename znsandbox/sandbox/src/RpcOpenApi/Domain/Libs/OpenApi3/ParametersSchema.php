<?php

namespace ZnSandbox\Sandbox\RpcOpenApi\Domain\Libs\OpenApi3;

use ZnCore\Contract\Encoder\Interfaces\EncodeInterface;

class ParametersSchema implements EncodeInterface
{

    public function encode($data, $in = 'header'): array
    {
        $props = [];
        foreach ($data as $k  => $v) {
            $vv['in'] = $in;
            $vv['name'] = $k;
            $vv['type'] = 'string';
//            $vv['type'] = gettype($v);
            $vv['readOnly'] = 'true';
            $vv['default'] = $v;
            $vv['description'] = 'description ' . $k;
//                    $vv['schema'] = cc($v);
            $props[] = $vv;
        }
        return $props;
    }
}
