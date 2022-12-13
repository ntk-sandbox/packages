<?php

namespace ZnFramework\Rpc\Domain\Enums;

class RpcEventEnum
{

    /** До выполнения экшена */
    const BEFORE_RUN_ACTION = 'rpcFramework.before_run_action';

    const AFTER_RUN_ACTION = 'rpcFramework.after_run_action';

    const METHOD_NOT_FOUND = 'rpcFramework.method_not_found';

    const CLIENT_REQUEST = 'rpcFramework.client_request';
}
