<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Libs;

use App\Application\Admin\Libs\AdminApp;
use App\Application\Rpc\Libs\RpcApp;
use App\Application\Web\Libs\WebApp;
use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Illuminate\Cookie\CookieValuePrefix;
use Illuminate\Testing\LoggedExceptionCollection;
use Illuminate\Testing\TestResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile as SymfonyUploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use ZnCore\Code\Helpers\DeprecateHelper;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnCore\Text\Helpers\Inflector;
use ZnSandbox\Sandbox\WebTest\Domain\Interfaces\PluginInterface;
use ZnSandbox\Sandbox\WebTest\Domain\Traits\PluginParentTrait;

abstract class BaseMockHttpClient
{

    /**
     * Additional headers for the request.
     *
     * @var array
     */
    protected $defaultHeaders = [];

    /**
     * Additional cookies for the request.
     *
     * @var array
     */
    protected $defaultCookies = [];

    /**
     * Additional cookies will not be encrypted for the request.
     *
     * @var array
     */
//    protected $unencryptedCookies = [];

    /**
     * Additional server variables for the request.
     *
     * @var array
     */
    protected $serverVariables = [];

    /**
     * Indicates whether redirects should be followed.
     *
     * @var bool
     */
    protected $followRedirects = false;

    /**
     * Indicates whether cookies should be encrypted.
     *
     * @var bool
     */
//    protected $encryptCookies = true;

    /**
     * Indicated whether JSON requests should be performed "with credentials" (cookies).
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/withCredentials
     *
     * @var bool
     */
    protected $withCredentials = false;

    protected $plugins = [];

    public function __construct(
        private ?AppFactory $appFactory = null
    )
    {
    }

    /**
     * Define additional headers to be sent with the request.
     *
     * @param  array  $headers
     * @return $this
     */
    public function withHeaders(array $headers)
    {
        $this->defaultHeaders = array_merge($this->defaultHeaders, $headers);

        return $this;
    }

    /**
     * Add a header to be sent with the request.
     *
     * @param  string  $name
     * @param  string  $value
     * @return $this
     */
    public function withHeader(string $name, string $value)
    {
        $this->defaultHeaders[$name] = $value;

        return $this;
    }

    public function removeHeader(string $name)
    {
        unset($this->defaultHeaders[$name]);

        return $this;
    }

    /**
     * Flush all the configured headers.
     *
     * @return $this
     */
    public function flushHeaders()
    {
        $this->defaultHeaders = [];

        return $this;
    }

    /**
     * Define a set of server variables to be sent with the requests.
     *
     * @param  array  $server
     * @return $this
     */
    public function withServerVariables(array $server)
    {
        $this->serverVariables = $server;

        return $this;
    }

    /**
     * Define additional cookies to be sent with the request.
     *
     * @param  array  $cookies
     * @return $this
     */
    public function withCookies(array $cookies)
    {
        $this->defaultCookies = array_merge($this->defaultCookies, $cookies);

        return $this;
    }

    /**
     * Add a cookie to be sent with the request.
     *
     * @param  string  $name
     * @param  string  $value
     * @return $this
     */
    public function withCookie(string $name, string $value)
    {
        $this->defaultCookies[$name] = $value;

        return $this;
    }

//    /**
//     * Define additional cookies will not be encrypted before sending with the request.
//     *
//     * @param  array  $cookies
//     * @return $this
//     */
//    public function withUnencryptedCookies(array $cookies)
//    {
//        $this->unencryptedCookies = array_merge($this->unencryptedCookies, $cookies);
//
//        return $this;
//    }

//    /**
//     * Add a cookie will not be encrypted before sending with the request.
//     *
//     * @param  string  $name
//     * @param  string  $value
//     * @return $this
//     */
//    public function withUnencryptedCookie(string $name, string $value)
//    {
//        $this->unencryptedCookies[$name] = $value;
//
//        return $this;
//    }

    /**
     * Automatically follow any redirects returned from the response.
     *
     * @return $this
     */
    public function followingRedirects()
    {
        $this->followRedirects = true;

        return $this;
    }

    /**
     * Include cookies and authorization headers for JSON requests.
     *
     * @return $this
     */
    public function withCredentials()
    {
        $this->withCredentials = true;

        return $this;
    }

//    /**
//     * Disable automatic encryption of cookie values.
//     *
//     * @return $this
//     */
//    public function disableCookieEncryption()
//    {
//        $this->encryptCookies = false;
//
//        return $this;
//    }

    public function addPlugin(object $plugin, string $name = null) {
        if(empty($name)) {
            $name = get_class($plugin);
        }

        if(property_exists($plugin, 'client')) {
//            dump(111);
            $plugin->client = $this;

        }

        $this->plugins[$name] = $plugin;
    }

    public function getPlugin(string $name): object {
        return $this->plugins[$name];
    }

    protected function runPlugins(array $requestData): array {
        foreach ($this->plugins as $plugin) {
            if ($plugin instanceof PluginInterface) {
                $requestData = $plugin->run($requestData);
            }
        }
        return $requestData;
    }

    public function call($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null): Response
    {
        $request = $this->createRequestInstance($method, $uri, $parameters, $cookies, $files, $server, $content);
        return $this->handleRequest($request);
    }

    protected function createRequestInstance($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null): Request {
        $request = Request::create(
            $this->prepareUrlForRequest($uri),
            $method,
            $parameters,
            $cookies,
            $files,
            array_replace($this->serverVariables, $server),
            $content
        );
        return $request;
    }

    /*protected function createKernelInstance(Request $request): HttpKernelInterface {
        $framework = $this->appFactory->createKernelInstance($request);
        return $framework;
    }*/
    
    /**
     * Обработка HTTP-запроса средствами HTTP-фрэймворка.
     *
     * @param Request $request
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @deprecated 
     */
    public function handleRequest(Request $request): Response
    {
        DeprecateHelper::hardThrow();
        
        /** @var HttpKernelInterface | TerminableInterface $framework */
//        $framework = $this->container->get(HttpKernelInterface::class);

        $framework = $this->appFactory->createKernelInstance($request);

        // actually execute the kernel, which turns the request into a response
        // by dispatching events, calling a controller, and returning the response
        $response = $framework->handle($request);

        // send the headers and echo the content
        // $response->send();

        // trigger the kernel.terminate event
        $framework->terminate($request, $response);

        if ($this->followRedirects) {
            $response = $this->followRedirects($response);
        }

        return $response;
    }

    /**
     * Follow a redirect chain until a non-redirect is received.
     *
     * @param  Response $response
     * @return Response
     */
    protected function followRedirects($response)
    {
        $this->followRedirects = false;

        while ($response->isRedirect()) {
            $response = $this->get($response->headers->get('Location'));
        }

        return $response;
    }

    /**
     * Turn the given URI into a fully qualified URL.
     *
     * @param  string  $uri
     * @return string
     */
    protected function prepareUrlForRequest($uri)
    {
        if (str_starts_with($uri, '/')) {
            $uri = substr($uri, 1);
        }

        return trim($uri, '/');
    }

    /**
     * Transform headers array to array of $_SERVER vars with HTTP_* format.
     *
     * @param  array  $headers
     * @return array
     */
    protected function transformHeadersToServerVars(array $headers)
    {
//        $headers = $this->prepareHeaderKeys($headers);
        return collect($headers)->mapWithKeys(function ($value, $name) {
            $name = strtr(strtoupper($name), '-', '_');

            return [$this->formatServerHeaderKey($name) => $value];
        })->all();
    }

    /**
     * Format the header name for the server array.
     *
     * @param  string  $name
     * @return string
     */
    protected function formatServerHeaderKey($name)
    {
        if (! str_starts_with($name, 'HTTP_') && $name !== 'CONTENT_TYPE' && $name !== 'REMOTE_ADDR') {
            return 'HTTP_'.$name;
        }

        return $name;
    }

    /**
     * Extract the file uploads from the given data array.
     *
     * @param  array  $data
     * @return array
     */
    protected function extractFilesFromDataArray(&$data)
    {
        $files = [];

        foreach ($data as $key => $value) {
            if ($value instanceof SymfonyUploadedFile) {
                $files[$key] = $value;

                unset($data[$key]);
            }

            if (is_array($value)) {
                $files[$key] = $this->extractFilesFromDataArray($value);

                $data[$key] = $value;
            }
        }

        return $files;
    }

    /**
     * If enabled, encrypt cookie values for request.
     *
     * @return array
     */
    protected function prepareCookiesForRequest()
    {
        return $this->defaultCookies;
//        if (! $this->encryptCookies) {
//            return array_merge($this->defaultCookies, $this->unencryptedCookies);
//        }
//
//        return collect($this->defaultCookies)->map(function ($value, $key) {
//            return encrypt(CookieValuePrefix::create($key, app('encrypter')->getKey()).$value, false);
//        })->merge($this->unencryptedCookies)->all();
    }

    /**
     * If enabled, add cookies for JSON requests.
     *
     * @return array
     */
    protected function prepareCookiesForJsonRequest()
    {
        return $this->withCredentials ? $this->prepareCookiesForRequest() : [];
    }

    public function createRequest($method, $uri, array $data = [], array $headers = [], ?string $content = null, array $parameters = []): Request {
        $headers = array_merge($this->defaultHeaders, $headers);
        $headers = $this->prepareHeaderKeys($headers);

        $requestData = compact('method', 'uri', 'data', 'headers', 'content');
        $requestData = $this->runPlugins($requestData);
        extract($requestData);

        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();
        $files = $this->extractFilesFromDataArray($data);
        $request = $this->createRequestInstance($method, $uri, $parameters, $cookies, $files, $server, $content);
        return $request;
    }

    protected function prepareHeaderKeys(array $headers): array {
        $newHeaders = [];
        foreach ($headers as $headerKey => $headerValue) {
            $headerKey = Inflector::underscore($headerKey);
            $headerKey = strtoupper($headerKey);
            $newHeaders[$headerKey] = $headerValue;
        }
        $headers = $newHeaders;
        return $headers;
    }

    protected function callRequest(string $method, $uri, array $data = [], array $headers = []) {
        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();
        return $this->call($method, $uri, $data, $cookies, [], $server);
    }

}
