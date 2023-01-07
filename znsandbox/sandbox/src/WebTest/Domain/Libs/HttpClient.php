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

class HttpClient extends BaseMockHttpClient
{
    
//    /**
//     * The latest test response (if any).
//     *
//     * @var \Illuminate\Testing\TestResponse|null
//     */
//    public static $latestResponse;

    /**
     * Add an authorization token for the request.
     *
     * @param  string  $token
     * @param  string  $type
     * @return $this
     */
    public function withToken(string $token, string $type = 'Bearer')
    {
        return $this->withHeader('Authorization', $type.' '.$token);
    }

    /**
     * Remove the authorization token from the request.
     *
     * @return $this
     */
    public function withoutToken()
    {
        unset($this->defaultHeaders['Authorization']);

        return $this;
    }

//    /**
//     * Disable middleware for the test.
//     *
//     * @param  string|array|null  $middleware
//     * @return $this
//     */
//    public function withoutMiddleware($middleware = null)
//    {
//        if (is_null($middleware)) {
//            $this->app->instance('middleware.disable', true);
//
//            return $this;
//        }
//
//        foreach ((array) $middleware as $abstract) {
//            $this->app->instance($abstract, new class
//            {
//                public function handle($request, $next)
//                {
//                    return $next($request);
//                }
//            });
//        }
//
//        return $this;
//    }

//    /**
//     * Enable the given middleware for the test.
//     *
//     * @param  string|array|null  $middleware
//     * @return $this
//     */
//    public function withMiddleware($middleware = null)
//    {
//        if (is_null($middleware)) {
//            unset($this->app['middleware.disable']);
//
//            return $this;
//        }
//
//        foreach ((array) $middleware as $abstract) {
//            unset($this->app[$abstract]);
//        }
//
//        return $this;
//    }

//    /**
//     * Set the referer header and previous URL session value in order to simulate a previous request.
//     *
//     * @param  string  $url
//     * @return $this
//     */
//    public function from(string $url)
//    {
//        $this->app['session']->setPreviousUrl($url);
//
//        return $this->withHeader('referer', $url);
//    }

    /**
     * Visit the given URI with a GET request.
     *
     * @param  string  $uri
     * @param  array  $headers
     * @return Response
     */
    public function get($uri, array $headers = [])
    {
        return $this->callRequest('GET', $uri, [], $headers);
//        $server = $this->transformHeadersToServerVars($headers);
//        $cookies = $this->prepareCookiesForRequest();
//        return $this->call('GET', $uri, [], $cookies, [], $server);
    }

    /**
     * Visit the given URI with a POST request.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     * @return Response
     */
    public function post($uri, array $data = [], array $headers = [])
    {
        return $this->callRequest('POST', $uri, $data, $headers);
//        $server = $this->transformHeadersToServerVars($headers);
//        $cookies = $this->prepareCookiesForRequest();
//        return $this->call('POST', $uri, $data, $cookies, [], $server);
    }

    /**
     * Visit the given URI with a PUT request.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     * @return Response
     */
    public function put($uri, array $data = [], array $headers = [])
    {
        return $this->callRequest('PUT', $uri, $data, $headers);
//        $server = $this->transformHeadersToServerVars($headers);
//        $cookies = $this->prepareCookiesForRequest();
//        return $this->call('PUT', $uri, $data, $cookies, [], $server);
    }

    public function createRequest($method, $uri, array $data = [], array $headers = []): Request {
        $parameters = [];
        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();
        $files = $this->extractFilesFromDataArray($data);

        $request = $this->createRequestInstance($method, $uri, $parameters, $cookies, $files, $server, $content);
        return $request;
    }

    protected function callRequest(string $method, $uri, array $data = [], array $headers = []) {
        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();

        return $this->call($method, $uri, $data, $cookies, [], $server);
    }
    
    /**
     * Visit the given URI with a PATCH request.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     * @return Response
     */
    public function patch($uri, array $data = [], array $headers = [])
    {
        return $this->callRequest('PATCH', $uri, $data, $headers);
//        $server = $this->transformHeadersToServerVars($headers);
//        $cookies = $this->prepareCookiesForRequest();
//        return $this->call('PATCH', $uri, $data, $cookies, [], $server);
    }

    /**
     * Visit the given URI with a DELETE request.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     * @return Response
     */
    public function delete($uri, array $data = [], array $headers = [])
    {
        return $this->callRequest('DELETE', $uri, $data, $headers);
//        $server = $this->transformHeadersToServerVars($headers);
//        $cookies = $this->prepareCookiesForRequest();
//        return $this->call('DELETE', $uri, $data, $cookies, [], $server);
    }

    /**
     * Visit the given URI with an OPTIONS request.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     * @return Response
     */
    public function options($uri, array $data = [], array $headers = [])
    {
        return $this->callRequest('OPTIONS', $uri, $data, $headers);
//        $server = $this->transformHeadersToServerVars($headers);
//        $cookies = $this->prepareCookiesForRequest();
//        return $this->call('OPTIONS', $uri, $data, $cookies, [], $server);
    }

    /**
     * Visit the given URI with a HEAD request.
     *
     * @param  string  $uri
     * @param  array  $headers
     * @return Response
     */
    public function head($uri, array $headers = [])
    {
        return $this->callRequest('HEAD', $uri, [], $headers);
//        $server = $this->transformHeadersToServerVars($headers);
//        $cookies = $this->prepareCookiesForRequest();
//        return $this->call('HEAD', $uri, [], $cookies, [], $server);
    }

//    /**
//     * Call the given URI and return the Response.
//     *
//     * @param  string  $method
//     * @param  string  $uri
//     * @param  array  $parameters
//     * @param  array  $cookies
//     * @param  array  $files
//     * @param  array  $server
//     * @param  string|null  $content
//     * @return Response
//     */
//    public function call_old($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
//    {
//        $kernel = $this->app->make(HttpKernel::class);
//
//        $files = array_merge($files, $this->extractFilesFromDataArray($parameters));
//
//        $symfonyRequest = Request::create(
//            $this->prepareUrlForRequest($uri), $method, $parameters,
//            $cookies, $files, array_replace($this->serverVariables, $server), $content
//        );
//
//        $response = $kernel->handle(
//            $request = \Illuminate\Http\Request::createFromBase($symfonyRequest)
//        );
//
//        $kernel->terminate($request, $response);
//
//        if ($this->followRedirects) {
//            $response = $this->followRedirects($response);
//        }
//
//        return static::$latestResponse = $this->createTestResponse($response);
//    }
//
//    /**
//     * Create the test response instance from the given response.
//     *
//     * @param  \Illuminate\Http\Response  $response
//     * @return Response
//     */
//    protected function createTestResponse($response)
//    {
//        return tap(TestResponse::fromBaseResponse($response), function ($response) {
//            $response->withExceptions(
//                $this->app->bound(LoggedExceptionCollection::class)
//                    ? $this->app->make(LoggedExceptionCollection::class)
//                    : new LoggedExceptionCollection
//            );
//        });
//    }
}
