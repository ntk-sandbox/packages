<?php

return [
	'entities' => [
		'ZnBundle\\Geo\\Domain\\Entities\\CountryEntity' => 'ZnBundle\\Geo\\Domain\\Interfaces\\Repositories\\CountryRepositoryInterface',
		'ZnBundle\\Geo\\Domain\\Entities\\RegionEntity' => 'ZnBundle\\Geo\\Domain\\Interfaces\\Repositories\\RegionRepositoryInterface',
		'ZnBundle\\Geo\\Domain\\Entities\\LocalityEntity' => 'ZnBundle\\Geo\\Domain\\Interfaces\\Repositories\\LocalityRepositoryInterface',
		'ZnBundle\\Geo\\Domain\\Entities\\CurrencyEntity' => 'ZnBundle\\Geo\\Domain\\Interfaces\\Repositories\\CurrencyRepositoryInterface',
	],
];