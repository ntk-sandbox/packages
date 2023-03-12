<?php

namespace Untek\Lib\Rest\Tests\Unit\DSig;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Crypt\Base\Domain\Exceptions\FailSignatureException;
use Untek\Crypt\Base\Domain\Exceptions\InvalidDigestException;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Tool\Test\Traits\DataTestTrait;

final class RpcResponseDSigTest extends BaseRpcDSigTest
{

    use DataTestTrait;

    protected function baseDataDir(): string
    {
        return __DIR__ . '/../../data/RpcDSigTest';
    }

    public function testSignResponse()
    {
        $responseEntity = new RpcResponseEntity();
        $responseEntity->setResult([
            "token" => "bearer kQuZ4abuj5ZiDZibe2WymSeU0pGZzbRL"
        ]);
        $responseEntity->setId(1);
        $responseEntity->addMeta("Language", "ru");
        $dSig = $this->getDSig();
        $dSig->signResponse($responseEntity);
        $dSig->verifyResponse($responseEntity);
        $responseArray = EntityHelper::toArray($responseEntity);
        $expected = $this->loadData('signedResponse.json');
        $this->assertSame($expected, $responseArray);
    }

    public function testVerifyResponse()
    {
        $responseEntity = new RpcResponseEntity();
        $signedData = $this->loadData('signedResponse.json');
        PropertyHelper::setAttributes($responseEntity, $signedData);
        $dSig = $this->getDSig();
        $dSig->verifyResponse($responseEntity);
        $this->assertTrue(true);
    }

    public function testVerifyResponseFailDigest()
    {
        $responseEntity = new RpcResponseEntity();
        $signedData = $this->loadData('signedResponseFailDigest.json');
        PropertyHelper::setAttributes($responseEntity, $signedData);
        $dSig = $this->getDSig();
        $this->expectException(InvalidDigestException::class);
        $dSig->verifyResponse($responseEntity);
    }

    public function testVerifyResponseFailSignature()
    {
        $responseEntity = new RpcResponseEntity();
        $signedData = $this->loadData('signedResponseFailSignature.json');
        PropertyHelper::setAttributes($responseEntity, $signedData);
        $dSig = $this->getDSig();
        $this->expectException(FailSignatureException::class);
        $dSig->verifyResponse($responseEntity);
    }
}
