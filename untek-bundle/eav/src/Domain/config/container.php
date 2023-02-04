<?php

return [
	'singletons' => [
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Repositories\\CategoryRepositoryInterface' => 'Untek\\Bundle\\Eav\\Domain\\Repositories\\Eloquent\\CategoryRepository',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Repositories\\EntityRepositoryInterface' => 'Untek\\Bundle\\Eav\\Domain\\Repositories\\Eloquent\\EntityRepository',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Repositories\\EntityAttributeRepositoryInterface' => 'Untek\\Bundle\\Eav\\Domain\\Repositories\\Eloquent\\EntityAttributeRepository',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Repositories\\EnumRepositoryInterface' => 'Untek\\Bundle\\Eav\\Domain\\Repositories\\Eloquent\\EnumRepository',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Repositories\\AttributeRepositoryInterface' => 'Untek\\Bundle\\Eav\\Domain\\Repositories\\Eloquent\\AttributeRepository',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Repositories\\ValidationRepositoryInterface' => 'Untek\\Bundle\\Eav\\Domain\\Repositories\\Eloquent\\ValidationRepository',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Repositories\\MeasureRepositoryInterface' => 'Untek\\Bundle\\Eav\\Domain\\Repositories\\Eloquent\\MeasureRepository',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Services\\CategoryServiceInterface' => 'Untek\\Bundle\\Eav\\Domain\\Services\\CategoryService',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Services\\EntityServiceInterface' => 'Untek\\Bundle\\Eav\\Domain\\Services\\EntityService',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Services\\EntityAttributeServiceInterface' => 'Untek\\Bundle\\Eav\\Domain\\Services\\EntityAttributeService',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Services\\EnumServiceInterface' => 'Untek\\Bundle\\Eav\\Domain\\Services\\EnumService',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Services\\AttributeServiceInterface' => 'Untek\\Bundle\\Eav\\Domain\\Services\\AttributeService',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Services\\ValidationServiceInterface' => 'Untek\\Bundle\\Eav\\Domain\\Services\\ValidationService',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Services\\MeasureServiceInterface' => 'Untek\\Bundle\\Eav\\Domain\\Services\\MeasureService',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Services\\ValueServiceInterface' => 'Untek\\Bundle\\Eav\\Domain\\Services\\ValueService',
		'Untek\\Bundle\\Eav\\Domain\\Interfaces\\Repositories\\ValueRepositoryInterface' => 'Untek\\Bundle\\Eav\\Domain\\Repositories\\Eloquent\\ValueRepository',
	],
];