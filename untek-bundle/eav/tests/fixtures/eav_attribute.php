<?php

return [
	'deps' => [
		'eav_measure',
	],
	'collection' => [
		[
			'id' => 2,
			'name' => 'season',
			'type' => 'enum',
			'is_required' => null,
			'default' => null,
			'title' => 'Сезон',
			'description' => null,
			'unit_id' => null,
			'status' => 1,
		],
		[
			'id' => 1,
			'name' => 'volume',
			'type' => 'string',
			'is_required' => null,
			'default' => null,
			'title' => 'Объем',
			'description' => null,
			'unit_id' => 5,
			'status' => 1,
		],
	],
];