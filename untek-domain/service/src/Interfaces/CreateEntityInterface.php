<?php

namespace Untek\Model\Service\Interfaces;

interface CreateEntityInterface
{

    /**
     * Создать сущность
     *
     * Создавать новые сущности должен уметь только сервис
     *
     * @param array $attributes
     * @return object
     */
    public function createEntity(array $attributes = []);

}