<?php
\Phar::interceptFileFuncs();
$pharUrl = \Phar::running(true);
$mountPath = $pharUrl . '/.mount/';
\Phar::mount($mountPath, __DIR__ . 'stub.php/');
__HALT_COMPILER();