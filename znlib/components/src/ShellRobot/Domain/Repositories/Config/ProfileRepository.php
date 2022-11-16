<?php

namespace ZnLib\Components\ShellRobot\Domain\Repositories\Config;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Collection\Libs\Collection;
use ZnDomain\Query\Entities\Query;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;

class ProfileRepository
{

    public function findOneByName(string $projectName)
    {
//        $collection = $this->findAll();
//        $query = new Query();
//        $query->where('title', $projectName);
//        $profiles = FilterHelper::filterByQuery($profiles, $query);
//        dd($profiles, $projectName);

        $profiles = $this->getItems();
        $profileConfig = $profiles[$projectName];
        return $profileConfig;
    }

    public function findAll(Query $query = null): Enumerable
    {
        $new = $this->getItems();
        return new Collection($new);
//        return $new;
    }

    private function getItems(): array
    {
        $profiles = ShellFactory::getConfigProcessor()->get('profiles');
        $new = [];
        foreach ($profiles as $profileName => $profileConfig) {
            if (!is_string($profileName)) {
                $hash = hash('sha256', $profileName);
                $profileName = $profileConfig['name'] ?? $hash;
            }
            $profileConfig['name'] = $profileName;
            $new[$profileName] = $profileConfig;
        }
        return $new;
    }
}
