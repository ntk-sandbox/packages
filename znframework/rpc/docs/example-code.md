# Пример использования

Создаем RPC-клиент:

```php
use GuzzleHttp\Client;
use ZnFramework\Rpc\Domain\Encoders\RequestEncoder;
use ZnFramework\Rpc\Domain\Encoders\ResponseEncoder;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Enums\HttpHeaderEnum;
use ZnFramework\Rpc\Domain\Enums\RpcVersionEnum;
use ZnFramework\Rpc\Domain\Libs\RpcClient;

require_once __DIR__ . '/../vendor/autoload.php';

$config = [
    'base_uri' =>'https://example.com/json-rpc' ,
];
$guzzleClient = new Client($config);
$rpcClient = new RpcClient($guzzleClient, new RequestEncoder(), new ResponseEncoder());
```

Делаем запрос:

```php
$request = new RpcRequestEntity();
$request->setJsonrpc(RpcVersionEnum::V2_0);
$request->setMethod('auth.getToken');
$request->setParamItem('login', '');
$request->setParamItem('password', '');
$response = $rpcClient->sendRequestByEntity($request);
var_dump($response);
```

Если требуется сделать авторизованный запрос:

```php
$request = new RpcRequestEntity();
$request->setJsonrpc(RpcVersionEnum::V2_0);
$request->setMethod('news.all');
$request->addMeta(HttpHeaderEnum::AUTHORIZATION, 'jwt eyJ0eXAiOi...');
$response = $rpcClient->sendRequestByEntity($request);
var_dump($response);
```
