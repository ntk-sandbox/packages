<?php

namespace ZnSandbox\Sandbox\Asset\Symfony4\Web\Controllers;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\MimeTypes;
use ZnCore\FileSystem\Helpers\FilePathHelper;
use ZnLib\Components\Http\Enums\HttpHeaderEnum;
use ZnLib\Components\Http\Enums\HttpStatusCodeEnum;
use ZnLib\Web\Controller\Base\BaseWebController;

class AssetsController extends BaseWebController
{

    protected $baseUri = '/assets';
    protected $profiles = [
        'vendor' => __DIR__ . '/../../../dist/vendor',
        'app' => __DIR__ . '/../../../dist/app',
    ];

    public function open(Request $request): Response
    {
        $uri = $request->getRequestUri();
        $filePath = str_replace($this->baseUri, '', $uri);
        $filePath = trim($filePath, '/');
        $absoluteFilePath = $this->getAbsoluteFilePath($filePath);
        if (!file_exists($absoluteFilePath)) {
            $response = new Response();
            $response->setStatusCode(HttpStatusCodeEnum::NOT_FOUND);
        } else {
            $response = new BinaryFileResponse($absoluteFilePath);
            $mime = $this->getMime($absoluteFilePath);
            $response->headers->set(HttpHeaderEnum::CONTENT_TYPE, $mime);
        }
        return $response;
    }

    private function getMime($absoluteFilePath): string
    {
        $fileName = basename($absoluteFilePath);
        $ext = FilePathHelper::fileExt($fileName);
        $mimeTypes = new MimeTypes();
        $mime = $mimeTypes->getMimeTypes($ext)[0] ?? 'application/octet-stream';
        return $mime;
    }

    private function getAbsoluteFilePath(string $filePath): string
    {
        $arr = explode('/', $filePath);
        $profileName = $arr[0];
        $relativeFilePath = substr($filePath, strlen($profileName) + 1);
        $profileDirectory = realpath($this->profiles[$profileName]);
        $absoluteFilePath = $profileDirectory . '/' . $relativeFilePath;
        return $absoluteFilePath;
    }
}
