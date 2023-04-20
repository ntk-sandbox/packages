<?php


/**
 * @var $this \Untek\Component\Web\HtmlRender\Application\Services\View
 * @var $rpcResponseEntity \Untek\Framework\Rpc\Domain\Model\RpcResponseEntity
 * @var $rpcRequestEntity \Untek\Framework\Rpc\Domain\Model\RpcRequestEntity
 */

use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Infrastructure\Encoders\RequestEncoder;
use Untek\Framework\Rpc\Infrastructure\Encoders\ResponseEncoder;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\ApiKeyEntity;

$responseEncoder = new ResponseEncoder();
$responseData = $responseEncoder->encode(EntityHelper::toArray($rpcResponseEntity, true));

$requestEncoder = new RequestEncoder();
$requestData = $requestEncoder->encode(EntityHelper::toArray($rpcRequestEntity, true));

if (empty($requestData['params']['body'])) {
    unset($requestData['params']['body']);
}
if (empty($requestData['params']['meta'])) {
    unset($requestData['params']['meta']);
}
if (empty($requestData['params'])) {
    unset($requestData['params']);
}

$responseCode = json_encode($responseData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$requestCode = json_encode($requestData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css" integrity="sha512-3xLMEigMNYLDJLAgaGlDSxpGykyb+nQnJBzbkQy2a0gyVKL2ZpNOPIj1rD8IPFaJbwAgId/atho1+LBpWu5DhA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js" integrity="sha512-MinqHeqca99q5bWxFNQEQpplMBFiUNrEwuuDj2rCSh1DgeeTXUgvgYIHZ1puBS9IKBkdfLMSk/ZWVDasa3Y/2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/languages/json.min.js" integrity="sha512-aZMByzpBNWHq5dwl9+wCH9CvkJere5i2d/sOShXk/8IiGeROWL6gdUu/PzIqA8BnS+YSm61yXXBHlMb0RZVrHg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<ul class="nav nav-tabs" id="result-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link" id="result-request-tab" data-toggle="pill" href="#result-request" role="tab"
           aria-controls="result-request" aria-selected="false">request</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" id="result-response-tab" data-toggle="pill" href="#result-response"
           role="tab" aria-controls="result-response" aria-selected="true">response</a>
    </li>
</ul>

<?php if ($rpcRequestEntity): ?>
    <div class="tab-content" id="result-tabContent">
        <div class="tab-pane fade" id="result-request" role="tabpanel" aria-labelledby="result-request-tab">
            <?php if ($rpcRequestEntity): ?>
                <small>

                    <pre><code class="language-json"><?= htmlspecialchars($requestCode) ?></code></pre>

                </small>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade active show" id="result-response" role="tabpanel"
             aria-labelledby="result-response-tab">
            <?php if ($rpcResponseEntity): ?>
                <small>
                    <pre><code class="language-json"><?= htmlspecialchars($responseCode) ?></code></pre>
                </small>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<script>hljs.highlightAll();</script>
