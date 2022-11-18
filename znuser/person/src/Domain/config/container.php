<?php

return [
	'singletons' => [
		'ZnUser\\Person\\Domain\\Interfaces\\Services\\InheritanceServiceInterface' => 'ZnUser\\Person\\Domain\\Services\\InheritanceService',
		'ZnUser\\Person\\Domain\\Interfaces\\Repositories\\InheritanceRepositoryInterface' => 'ZnUser\\Person\\Domain\\Repositories\\Eloquent\\InheritanceRepository',
		'ZnUser\\Person\\Domain\\Interfaces\\Services\\PersonServiceInterface' => 'ZnUser\\Person\\Domain\\Services\\PersonService',
		'ZnUser\\Person\\Domain\\Interfaces\\Repositories\\PersonRepositoryInterface' => 'ZnUser\\Person\\Domain\\Repositories\\Eloquent\\PersonRepository',
		'ZnUser\\Person\\Domain\\Interfaces\\Services\\MyPersonServiceInterface' => 'ZnUser\\Person\\Domain\\Services\\MyPersonService',
		'ZnUser\\Person\\Domain\\Interfaces\\Services\\ContactServiceInterface' => 'ZnUser\\Person\\Domain\\Services\\ContactService',
		'ZnUser\\Person\\Domain\\Interfaces\\Services\\MyContactServiceInterface' => 'ZnUser\\Person\\Domain\\Services\\MyContactService',
		'ZnUser\\Person\\Domain\\Interfaces\\Services\\MyChildServiceInterface' => 'ZnUser\\Person\\Domain\\Services\\MyChildService',
		'ZnUser\\Person\\Domain\\Interfaces\\Repositories\\ContactRepositoryInterface' => 'ZnUser\\Person\\Domain\\Repositories\\Eloquent\\ContactRepository',
		'ZnUser\\Person\\Domain\\Interfaces\\Services\\ContactTypeServiceInterface' => 'ZnUser\\Person\\Domain\\Services\\ContactTypeService',
		'ZnUser\\Person\\Domain\\Interfaces\\Services\\SexServiceInterface' => 'ZnUser\\Person\\Domain\\Services\\SexService',
		'ZnUser\\Person\\Domain\\Interfaces\\Repositories\\SexRepositoryInterface' => 'ZnUser\\Person\\Domain\\Repositories\\Eloquent\\SexRepository',
		'ZnUser\\Person\\Domain\\Interfaces\\Services\\ChildServiceInterface' => 'ZnUser\\Person\\Domain\\Services\\ChildService',

        'ZnBundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface' => 'ZnBundle\Person\Domain\Repositories\Eloquent\ContactTypeRepository',
	],
	/*'entities' => [
		'ZnUser\\Person\\Domain\\Entities\\InheritanceEntity' => 'ZnUser\\Person\\Domain\\Interfaces\\Repositories\\InheritanceRepositoryInterface',
		'ZnUser\\Person\\Domain\\Entities\\PersonEntity' => 'ZnUser\\Person\\Domain\\Interfaces\\Repositories\\PersonRepositoryInterface',
		'ZnUser\\Person\\Domain\\Entities\\ContactEntity' => 'ZnUser\\Person\\Domain\\Interfaces\\Repositories\\ContactRepositoryInterface',
	],*/
];