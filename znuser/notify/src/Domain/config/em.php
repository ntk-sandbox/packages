<?php

return [
	'entities' => [
		'ZnUser\\Notify\\Domain\\Entities\\TypeEntity' => 'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\TypeRepositoryInterface',
		'ZnUser\\Notify\\Domain\\Entities\\NotifyEntity' => 'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\HistoryRepositoryInterface',
		'ZnUser\\Notify\\Domain\\Entities\\SettingEntity' => 'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\SettingRepositoryInterface',
		'ZnUser\\Notify\\Domain\\Entities\\TransportEntity' => 'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\TransportRepositoryInterface',
		'ZnUser\\Notify\\Domain\\Entities\\TypeTransportEntity' => 'ZnUser\\Notify\\Domain\\Interfaces\\Repositories\\TypeTransportRepositoryInterface',
	],
];