<?php

return [
	'singletons' => [
		'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\HistoryRepositoryInterface' => 'Untek\\User\\Notify\\Domain\\Repositories\\Eloquent\\HistoryRepository',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\TypeRepositoryInterface' => 'Untek\\User\\Notify\\Domain\\Repositories\\Eloquent\\TypeRepository',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\TypeI18nRepositoryInterface' => 'Untek\\User\\Notify\\Domain\\Repositories\\Eloquent\\TypeI18nRepository',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\ActivityRepositoryInterface' => 'Untek\\User\\Notify\\Domain\\Repositories\\Eloquent\\ActivityRepository',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\SettingRepositoryInterface' => 'Untek\\User\\Notify\\Domain\\Repositories\\Eloquent\\SettingRepository',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Services\\HistoryServiceInterface' => 'Untek\\User\\Notify\\Domain\\Services\\HistoryService',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Services\\MyHistoryServiceInterface' => 'Untek\\User\\Notify\\Domain\\Services\\MyHistoryService',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Services\\ActivityServiceInterface' => 'Untek\\User\\Notify\\Domain\\Services\\ActivityService',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Services\\NotifyServiceInterface' => 'Untek\\User\\Notify\\Domain\\Services\\NotifyService',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Services\\TypeServiceInterface' => 'Untek\\User\\Notify\\Domain\\Services\\TypeService',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Services\\SettingServiceInterface' => 'Untek\\User\\Notify\\Domain\\Services\\SettingService',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Services\\TransportServiceInterface' => 'Untek\\User\\Notify\\Domain\\Services\\TransportService',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\TransportRepositoryInterface' => 'Untek\\User\\Notify\\Domain\\Repositories\\Eloquent\\TransportRepository',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Services\\TypeTransportServiceInterface' => 'Untek\\User\\Notify\\Domain\\Services\\TypeTransportService',
		'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\TypeTransportRepositoryInterface' => 'Untek\\User\\Notify\\Domain\\Repositories\\Eloquent\\TypeTransportRepository',
	],
];