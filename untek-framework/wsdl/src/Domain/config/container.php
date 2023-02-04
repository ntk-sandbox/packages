<?php

return [
	'singletons' => [
		'Untek\\Framework\\Wsdl\\Domain\\Interfaces\\Services\\RequestServiceInterface' => 'Untek\\Framework\\Wsdl\\Domain\\Services\\RequestService',
		'Untek\\Framework\\Wsdl\\Domain\\Interfaces\\Services\\TransportServiceInterface' => 'Untek\\Framework\\Wsdl\\Domain\\Services\\TransportService',
		'Untek\\Framework\\Wsdl\\Domain\\Interfaces\\Repositories\\TransportRepositoryInterface' => 'Untek\\Framework\\Wsdl\\Domain\\Repositories\\Eloquent\\TransportRepository',
		'Untek\\Framework\\Wsdl\\Domain\\Interfaces\\Repositories\\ClientRepositoryInterface' => 'Untek\\Framework\\Wsdl\\Domain\\Repositories\\Wsdl\\ClientRepository',
//		'Untek\\Framework\\Wsdl\\Domain\\Interfaces\\Repositories\\ServiceRepositoryInterface' => 'Untek\\Framework\\Wsdl\\Domain\\Repositories\\File\\ServiceRepository',
	],
];