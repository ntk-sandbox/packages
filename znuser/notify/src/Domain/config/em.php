<?php

return [
	'entities' => [
		'Untek\\User\\Notify\\Domain\\Entities\\TypeEntity' => 'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\TypeRepositoryInterface',
		'Untek\\User\\Notify\\Domain\\Entities\\NotifyEntity' => 'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\HistoryRepositoryInterface',
		'Untek\\User\\Notify\\Domain\\Entities\\SettingEntity' => 'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\SettingRepositoryInterface',
		'Untek\\User\\Notify\\Domain\\Entities\\TransportEntity' => 'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\TransportRepositoryInterface',
		'Untek\\User\\Notify\\Domain\\Entities\\TypeTransportEntity' => 'Untek\\User\\Notify\\Domain\\Interfaces\\Repositories\\TypeTransportRepositoryInterface',
	],
];