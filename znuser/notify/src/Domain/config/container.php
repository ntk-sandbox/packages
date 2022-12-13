<?php

return [
	'singletons' => [
		'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\HistoryRepositoryInterface' => 'ZnUser\\Notify\\Domain\\Repositories\\Eloquent\\HistoryRepository',
		'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\TypeRepositoryInterface' => 'ZnUser\\Notify\\Domain\\Repositories\\Eloquent\\TypeRepository',
		'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\TypeI18nRepositoryInterface' => 'ZnUser\\Notify\\Domain\\Repositories\\Eloquent\\TypeI18nRepository',
		'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\ActivityRepositoryInterface' => 'ZnUser\\Notify\\Domain\\Repositories\\Eloquent\\ActivityRepository',
		'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\SettingRepositoryInterface' => 'ZnUser\\Notify\\Domain\\Repositories\\Eloquent\\SettingRepository',
		'ZnUser\\Notify\\Domain\\Interfaces\\Services\\HistoryServiceInterface' => 'ZnUser\\Notify\\Domain\\Services\\HistoryService',
		'ZnUser\\Notify\\Domain\\Interfaces\\Services\\MyHistoryServiceInterface' => 'ZnUser\\Notify\\Domain\\Services\\MyHistoryService',
		'ZnUser\\Notify\\Domain\\Interfaces\\Services\\ActivityServiceInterface' => 'ZnUser\\Notify\\Domain\\Services\\ActivityService',
		'ZnUser\\Notify\\Domain\\Interfaces\\Services\\NotifyServiceInterface' => 'ZnUser\\Notify\\Domain\\Services\\NotifyService',
		'ZnUser\\Notify\\Domain\\Interfaces\\Services\\TypeServiceInterface' => 'ZnUser\\Notify\\Domain\\Services\\TypeService',
		'ZnUser\\Notify\\Domain\\Interfaces\\Services\\SettingServiceInterface' => 'ZnUser\\Notify\\Domain\\Services\\SettingService',
		'ZnUser\\Notify\\Domain\\Interfaces\\Services\\TransportServiceInterface' => 'ZnUser\\Notify\\Domain\\Services\\TransportService',
		'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\TransportRepositoryInterface' => 'ZnUser\\Notify\\Domain\\Repositories\\Eloquent\\TransportRepository',
		'ZnUser\\Notify\\Domain\\Interfaces\\Services\\TypeTransportServiceInterface' => 'ZnUser\\Notify\\Domain\\Services\\TypeTransportService',
		'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\TypeTransportRepositoryInterface' => 'ZnUser\\Notify\\Domain\\Repositories\\Eloquent\\TypeTransportRepository',
	],
];