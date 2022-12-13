<?php

return [
	'singletons' => [
		'ZnLib\\Components\\ShellRobot\\Domain\\Interfaces\\Services\\VarServiceInterface' => 'ZnLib\\Components\\ShellRobot\\Domain\\Services\\VarService',
		'ZnLib\\Components\\ShellRobot\\Domain\\Interfaces\\Repositories\\VarRepositoryInterface' => 'ZnLib\\Components\\ShellRobot\\Domain\\Repositories\\File\\VarRepository',
		'ZnLib\\Components\\ShellRobot\\Domain\\Interfaces\\Services\\ConfigServiceInterface' => 'ZnLib\\Components\\ShellRobot\\Domain\\Services\\ConfigService',
		'ZnLib\\Components\\ShellRobot\\Domain\\Interfaces\\Repositories\\ConfigRepositoryInterface' => 'ZnLib\\Components\\ShellRobot\\Domain\\Repositories\\File\\ConfigRepository',
		'ZnLib\\Components\\ShellRobot\\Domain\\Interfaces\\Services\\ConnectionServiceInterface' => 'ZnLib\\Components\\ShellRobot\\Domain\\Services\\ConnectionService',
		'ZnLib\\Components\\ShellRobot\\Domain\\Interfaces\\Repositories\\ConnectionRepositoryInterface' => 'ZnLib\\Components\\ShellRobot\\Domain\\Repositories\\File\\ConnectionRepository',
	],
];