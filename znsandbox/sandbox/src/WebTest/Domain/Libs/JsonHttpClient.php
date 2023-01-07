<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Libs;

use App\Application\Admin\Libs\AdminApp;
use App\Application\Rpc\Libs\RpcApp;
use App\Application\Web\Libs\WebApp;
//use Illuminate\Contracts\Http\Kernel as HttpKernel;
//use Illuminate\Cookie\CookieValuePrefix;
//use Illuminate\Testing\LoggedExceptionCollection;
//use Illuminate\Testing\TestResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile as SymfonyUploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use ZnCore\Container\Helpers\ContainerHelper;

class JsonHttpClient extends HttpClient
{


//    /**
//     * Visit the given URI with a GET request, expecting a JSON response.
//     *
//     * @param  string  $uri
//     * @param  array  $headers
//     * @return Response
//     */
//    public function get($uri, array $headers = [])
//    {
//        return $this->json('GET', $uri, [], $headers);
//    }
//
//    /**
//     * Visit the given URI with a POST request, expecting a JSON response.
//     *
//     * @param  string  $uri
//     * @param  array  $data
//     * @param  array  $headers
//     * @return Response
//     */
//    public function post($uri, array $data = [], array $headers = [])
//    {
//        return $this->json('POST', $uri, $data, $headers);
//    }
//
//    /**
//     * Visit the given URI with a PUT request, expecting a JSON response.
//     *
//     * @param  string  $uri
//     * @param  array  $data
//     * @param  array  $headers
//     * @return Response
//     */
//    public function put($uri, array $data = [], array $headers = [])
//    {
//        return $this->json('PUT', $uri, $data, $headers);
//    }
//
//    /**
//     * Visit the given URI with a PATCH request, expecting a JSON response.
//     *
//     * @param  string  $uri
//     * @param  array  $data
//     * @param  array  $headers
//     * @return Response
//     */
//    public function patch($uri, array $data = [], array $headers = [])
//    {
//        return $this->json('PATCH', $uri, $data, $headers);
//    }
//
//    /**
//     * Visit the given URI with a DELETE request, expecting a JSON response.
//     *
//     * @param  string  $uri
//     * @param  array  $data
//     * @param  array  $headers
//     * @return Response
//     */
//    public function delete($uri, array $data = [], array $headers = [])
//    {
//        return $this->json('DELETE', $uri, $data, $headers);
//    }
//
//    /**
//     * Visit the given URI with an OPTIONS request, expecting a JSON response.
//     *
//     * @param  string  $uri
//     * @param  array  $data
//     * @param  array  $headers
//     * @return Response
//     */
//    public function options($uri, array $data = [], array $headers = [])
//    {
//        return $this->json('OPTIONS', $uri, $data, $headers);
//    }



    protected function callRequest(string $method, $uri, array $data = [], array $headers = []) {
        $request = $this->createRequest($method, $uri, $data, $headers);
        return $this->handleRequest($request);
    }


    /**
     * Call the given URI with a JSON request.
     *
     * @param  string  $method
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     * @return Response
     */
    public function json($method, $uri, array $data = [], array $headers = [])
    {
        $request = $this->createRequest($method, $uri, $data, $headers);
        return $this->handleRequest($request);

        /*return $this->call(
            $method,
            $uri,
            $parameters,
            $cookies,
            $files,
            $server,
            $content
        );*/
    }

    public function createRequest($method, $uri, array $data = [], array $headers = []): Request {
        $files = $this->extractFilesFromDataArray($data);
        $content = json_encode($data);
        $jsonHeaders = [
            'CONTENT_LENGTH' => mb_strlen($content, '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ];
        $headers = array_merge($jsonHeaders, $headers);

        $parameters = [];
        $cookies = $this->prepareCookiesForJsonRequest();
        $server = $this->transformHeadersToServerVars($headers);

        $request = $this->createRequestInstance($method, $uri, $parameters, $cookies, $files, $server, $content);
        return $request;
    }

}
