<?php

namespace ZnCore\Contract\Arr\Interfaces;

/**
 * Возможность преобразовать данные в массив.
 * 
 * Например, объект сущности может быть преобразован в массив
 */
interface ToArrayInterface
{

    /**
     * Преобразовать данные в массив
     * @return array
     */
    public function toArray(): array;
}
