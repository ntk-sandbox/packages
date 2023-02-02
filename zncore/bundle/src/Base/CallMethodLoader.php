<?php

namespace ZnCore\Bundle\Base;

class CallMethodLoader extends BaseLoader
{

    public function loadAll(array $bundles): void
    {
        foreach ($bundles as $bundle) {
            $this->callMethod($bundle);
        }
    }
}
