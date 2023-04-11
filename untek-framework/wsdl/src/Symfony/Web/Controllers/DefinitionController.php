<?php

namespace Untek\Framework\Wsdl\Symfony\Web\Controllers;

use Untek\Framework\Wsdl\Domain\Interfaces\Repositories\ServiceRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Untek\Component\Http\Enums\HttpStatusCodeEnum;
use Untek\Core\FileSystem\Helpers\FileStorageHelper;
use Untek\Component\Web\Xml\Libs\XmlResponse;

class DefinitionController
{

    private $serviceRepository;

    public function __construct(
        ServiceRepositoryInterface $serviceRepository
    )
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index(Request $request): Response
    {
        $uri = $request->getRequestUri();
        $fileName = $this->getFileName($uri);
        if (!is_file($fileName)) {
            $response = new Response();
            $response->setStatusCode(HttpStatusCodeEnum::NOT_FOUND);
        } else {
            $wsdlXML = FileStorageHelper::load($fileName);
            $response = new XmlResponse();
//        $wsdlXML = $this->requestService->getWsdlDefinition();
//            $wsdlXML = str_replace('location="', 'location="/wsdl/definition/', $wsdlXML);
            $response->setXml($wsdlXML);
        }

        return $response;
    }

    protected function extractAppName(string $uri): string
    {
        $uri = trim($uri, '/');
        $uriSegments = explode('/', $uri);
        $appName = $uriSegments[1];
        return $appName;
    }

    protected function extractRelativeFileName(string $uri): string
    {
        $uri = trim($uri, '/');
        $uriSegments = explode('/', $uri);
        $uriSegmentsClean = array_slice($uriSegments, 3);
        $relativeFileName = implode('/', $uriSegmentsClean);
        return $relativeFileName;
    }

    protected function getFileName(string $uri): string
    {
        $relativeFileName = $this->extractRelativeFileName($uri);


        $appName = $this->extractAppName($uri);
//        dd($appName);
        $appConfig = $this->serviceRepository->findOneByName($appName);


        $fileName = $appConfig->getPath() . '/' . $relativeFileName;


//        dd($appConfig);

        $fileName = realpath($fileName);
        return $fileName;
    }
}
