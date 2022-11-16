<?php

return [
	'singletons' => [
		'ZnBundle\\Eav\\Domain\\Interfaces\\Repositories\\CategoryRepositoryInterface' => 'ZnBundle\\Eav\\Domain\\Repositories\\Eloquent\\CategoryRepository',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Repositories\\EntityRepositoryInterface' => 'ZnBundle\\Eav\\Domain\\Repositories\\Eloquent\\EntityRepository',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Repositories\\EntityAttributeRepositoryInterface' => 'ZnBundle\\Eav\\Domain\\Repositories\\Eloquent\\EntityAttributeRepository',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Repositories\\EnumRepositoryInterface' => 'ZnBundle\\Eav\\Domain\\Repositories\\Eloquent\\EnumRepository',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Repositories\\AttributeRepositoryInterface' => 'ZnBundle\\Eav\\Domain\\Repositories\\Eloquent\\AttributeRepository',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Repositories\\ValidationRepositoryInterface' => 'ZnBundle\\Eav\\Domain\\Repositories\\Eloquent\\ValidationRepository',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Repositories\\MeasureRepositoryInterface' => 'ZnBundle\\Eav\\Domain\\Repositories\\Eloquent\\MeasureRepository',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Services\\CategoryServiceInterface' => 'ZnBundle\\Eav\\Domain\\Services\\CategoryService',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Services\\EntityServiceInterface' => 'ZnBundle\\Eav\\Domain\\Services\\EntityService',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Services\\EntityAttributeServiceInterface' => 'ZnBundle\\Eav\\Domain\\Services\\EntityAttributeService',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Services\\EnumServiceInterface' => 'ZnBundle\\Eav\\Domain\\Services\\EnumService',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Services\\AttributeServiceInterface' => 'ZnBundle\\Eav\\Domain\\Services\\AttributeService',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Services\\ValidationServiceInterface' => 'ZnBundle\\Eav\\Domain\\Services\\ValidationService',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Services\\MeasureServiceInterface' => 'ZnBundle\\Eav\\Domain\\Services\\MeasureService',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Services\\ValueServiceInterface' => 'ZnBundle\\Eav\\Domain\\Services\\ValueService',
		'ZnBundle\\Eav\\Domain\\Interfaces\\Repositories\\ValueRepositoryInterface' => 'ZnBundle\\Eav\\Domain\\Repositories\\Eloquent\\ValueRepository',
	],
	/*'entities' => [
		'ZnBundle\\Eav\\Domain\\Entities\\ValueEntity' => 'ZnBundle\\Eav\\Domain\\Interfaces\\Repositories\\ValueRepositoryInterface',
	],*/
];