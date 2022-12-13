<?php

return [
	'singletons' => [
		'ZnFramework\\Wsdl\\Domain\\Interfaces\\Services\\RequestServiceInterface' => 'ZnFramework\\Wsdl\\Domain\\Services\\RequestService',
		'ZnFramework\\Wsdl\\Domain\\Interfaces\\Services\\TransportServiceInterface' => 'ZnFramework\\Wsdl\\Domain\\Services\\TransportService',
		'ZnFramework\\Wsdl\\Domain\\Interfaces\\Repositories\\TransportRepositoryInterface' => 'ZnFramework\\Wsdl\\Domain\\Repositories\\Eloquent\\TransportRepository',
		'ZnFramework\\Wsdl\\Domain\\Interfaces\\Repositories\\ClientRepositoryInterface' => 'ZnFramework\\Wsdl\\Domain\\Repositories\\Wsdl\\ClientRepository',
//		'ZnFramework\\Wsdl\\Domain\\Interfaces\\Repositories\\ServiceRepositoryInterface' => 'ZnFramework\\Wsdl\\Domain\\Repositories\\File\\ServiceRepository',
	],
];