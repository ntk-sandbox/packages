<?php

return [
	'singletons' => [
		'Untek\\User\\Person\\Domain\\Interfaces\\Services\\InheritanceServiceInterface' => 'Untek\\User\\Person\\Domain\\Services\\InheritanceService',
		'Untek\\User\\Person\\Domain\\Interfaces\\Repositories\\InheritanceRepositoryInterface' => 'Untek\\User\\Person\\Domain\\Repositories\\Eloquent\\InheritanceRepository',
		'Untek\\User\\Person\\Domain\\Interfaces\\Services\\PersonServiceInterface' => 'Untek\\User\\Person\\Domain\\Services\\PersonService',
		'Untek\\User\\Person\\Domain\\Interfaces\\Repositories\\PersonRepositoryInterface' => 'Untek\\User\\Person\\Domain\\Repositories\\Eloquent\\PersonRepository',
		'Untek\\User\\Person\\Domain\\Interfaces\\Services\\MyPersonServiceInterface' => 'Untek\\User\\Person\\Domain\\Services\\MyPersonService',
		'Untek\\User\\Person\\Domain\\Interfaces\\Services\\ContactServiceInterface' => 'Untek\\User\\Person\\Domain\\Services\\ContactService',
		'Untek\\User\\Person\\Domain\\Interfaces\\Services\\MyContactServiceInterface' => 'Untek\\User\\Person\\Domain\\Services\\MyContactService',
		'Untek\\User\\Person\\Domain\\Interfaces\\Services\\MyChildServiceInterface' => 'Untek\\User\\Person\\Domain\\Services\\MyChildService',
		'Untek\\User\\Person\\Domain\\Interfaces\\Repositories\\ContactRepositoryInterface' => 'Untek\\User\\Person\\Domain\\Repositories\\Eloquent\\ContactRepository',
		'Untek\\User\\Person\\Domain\\Interfaces\\Services\\ContactTypeServiceInterface' => 'Untek\\User\\Person\\Domain\\Services\\ContactTypeService',
		'Untek\\User\\Person\\Domain\\Interfaces\\Services\\SexServiceInterface' => 'Untek\\User\\Person\\Domain\\Services\\SexService',
		'Untek\\User\\Person\\Domain\\Interfaces\\Repositories\\SexRepositoryInterface' => 'Untek\\User\\Person\\Domain\\Repositories\\Eloquent\\SexRepository',
		'Untek\\User\\Person\\Domain\\Interfaces\\Services\\ChildServiceInterface' => 'Untek\\User\\Person\\Domain\\Services\\ChildService',

        'Untek\Bundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface' => 'Untek\Bundle\Person\Domain\Repositories\Eloquent\ContactTypeRepository',
	],
];