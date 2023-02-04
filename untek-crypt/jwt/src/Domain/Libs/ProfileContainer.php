<?php

namespace Untek\Crypt\Jwt\Domain\Libs;

use Untek\Crypt\Jwt\Domain\Entities\JwtProfileEntity;
use Untek\Crypt\Jwt\Domain\Helpers\ConfigProfileHelper;

//use Untek\Core\Base\Traits\ClassAttribute\MagicSetTrait;

class ProfileContainer //extends BaseContainer
{

    //use MagicSetTrait;

    public function setProfiles($profiles)
    {

        $this->setDefinitions($profiles);
    }

    protected function prepareDefinition($component)
    {
        $component = parent::prepareDefinition($component);
        $component['class'] = JwtProfileEntity::class;
        $component = ConfigProfileHelper::prepareDefinition($component);
        return $component;
    }

}
