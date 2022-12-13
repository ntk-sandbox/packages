<?php

return [
	'singletons' => [
		'ZnBundle\\Geo\\Domain\\Interfaces\\Services\\CountryServiceInterface' => 'ZnBundle\\Geo\\Domain\\Services\\CountryService',
		'ZnBundle\\Geo\\Domain\\Interfaces\\Repositories\\CountryRepositoryInterface' => 'ZnBundle\\Geo\\Domain\\Repositories\\Eloquent\\CountryRepository',
		'ZnBundle\\Geo\\Domain\\Interfaces\\Services\\RegionServiceInterface' => 'ZnBundle\\Geo\\Domain\\Services\\RegionService',
		'ZnBundle\\Geo\\Domain\\Interfaces\\Repositories\\RegionRepositoryInterface' => 'ZnBundle\\Geo\\Domain\\Repositories\\Eloquent\\RegionRepository',
		'ZnBundle\\Geo\\Domain\\Interfaces\\Services\\LocalityServiceInterface' => 'ZnBundle\\Geo\\Domain\\Services\\LocalityService',
		'ZnBundle\\Geo\\Domain\\Interfaces\\Repositories\\LocalityRepositoryInterface' => 'ZnBundle\\Geo\\Domain\\Repositories\\Eloquent\\LocalityRepository',
		'ZnBundle\\Geo\\Domain\\Interfaces\\Services\\CurrencyServiceInterface' => 'ZnBundle\\Geo\\Domain\\Services\\CurrencyService',
		'ZnBundle\\Geo\\Domain\\Interfaces\\Repositories\\CurrencyRepositoryInterface' => 'ZnBundle\\Geo\\Domain\\Repositories\\Eloquent\\CurrencyRepository',
	],
];