<?php

return [
	'singletons' => [
		'Untek\\Bundle\\Geo\\Domain\\Interfaces\\Services\\CountryServiceInterface' => 'Untek\\Bundle\\Geo\\Domain\\Services\\CountryService',
		'Untek\\Bundle\\Geo\\Domain\\Interfaces\\Repositories\\CountryRepositoryInterface' => 'Untek\\Bundle\\Geo\\Domain\\Repositories\\Eloquent\\CountryRepository',
		'Untek\\Bundle\\Geo\\Domain\\Interfaces\\Services\\RegionServiceInterface' => 'Untek\\Bundle\\Geo\\Domain\\Services\\RegionService',
		'Untek\\Bundle\\Geo\\Domain\\Interfaces\\Repositories\\RegionRepositoryInterface' => 'Untek\\Bundle\\Geo\\Domain\\Repositories\\Eloquent\\RegionRepository',
		'Untek\\Bundle\\Geo\\Domain\\Interfaces\\Services\\LocalityServiceInterface' => 'Untek\\Bundle\\Geo\\Domain\\Services\\LocalityService',
		'Untek\\Bundle\\Geo\\Domain\\Interfaces\\Repositories\\LocalityRepositoryInterface' => 'Untek\\Bundle\\Geo\\Domain\\Repositories\\Eloquent\\LocalityRepository',
		'Untek\\Bundle\\Geo\\Domain\\Interfaces\\Services\\CurrencyServiceInterface' => 'Untek\\Bundle\\Geo\\Domain\\Services\\CurrencyService',
		'Untek\\Bundle\\Geo\\Domain\\Interfaces\\Repositories\\CurrencyRepositoryInterface' => 'Untek\\Bundle\\Geo\\Domain\\Repositories\\Eloquent\\CurrencyRepository',
	],
];