<?php

return [
	'singletons' => [
		'ZnSandbox\\Sandbox\\I18n\\Domain\\Interfaces\\Services\\TranslateServiceInterface' => 'ZnSandbox\\Sandbox\\I18n\\Domain\\Services\\TranslateService',
		'ZnSandbox\\Sandbox\\I18n\\Domain\\Interfaces\\Repositories\\TranslateRepositoryInterface' => 'ZnSandbox\\Sandbox\\I18n\\Domain\\Repositories\\Eloquent\\TranslateRepository',
	],
	/*'entities' => [
		'ZnSandbox\\Sandbox\\I18n\\Domain\\Entities\\TranslateEntity' => 'ZnSandbox\\Sandbox\\I18n\\Domain\\Interfaces\\Repositories\\TranslateRepositoryInterface',
	],*/
];