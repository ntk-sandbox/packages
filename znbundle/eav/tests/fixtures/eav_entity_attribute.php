<?php

return [
	'deps' => [
		'eav_entity',
		'eav_attribute',
	],
	'collection' => [
		[
			'id' => 1,
			'entity_id' => 1,
			'attribute_id' => 1,
            'is_required' => true,
            'default' => null,
			'name' => null,
			'title' => null,
			'description' => null,
			'sort' => 10,
			'status' => 1,
		],
		[
			'id' => 2,
			'entity_id' => 1,
			'attribute_id' => 2,
            'is_required' => true,
            'default' => 'summer',
			'name' => null,
			'title' => null,
			'description' => null,
			'sort' => 20,
			'status' => 1,
		],
	],
];