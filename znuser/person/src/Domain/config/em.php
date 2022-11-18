<?php

return [
	'entities' => [
		'ZnUser\\Person\\Domain\\Entities\\InheritanceEntity' => 'ZnUser\\Person\\Domain\\Interfaces\\Repositories\\InheritanceRepositoryInterface',
		'ZnUser\\Person\\Domain\\Entities\\PersonEntity' => 'ZnUser\\Person\\Domain\\Interfaces\\Repositories\\PersonRepositoryInterface',
		'ZnUser\\Person\\Domain\\Entities\\ContactEntity' => 'ZnUser\\Person\\Domain\\Interfaces\\Repositories\\ContactRepositoryInterface',
	],
];