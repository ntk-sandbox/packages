<?php

return [
	'deps' => [
		'eav_attribute',
	],
	'collection' => [
		/*[
			'id' => 1,
			'attribute_id' => 1,
			'name' => 'NotBlank',
			'params' => null,
			'sort' => 10,
			'status' => 1,
		],*/
        [
            'id' => 2,
            'attribute_id' => 1,
            'name' => 'PositiveOrZero',
            'params' => null,
            'sort' => 20,
            'status' => 1,
        ],
		/*[
			'id' => 3,
			'attribute_id' => 2,
			'name' => 'NotBlank',
			'params' => null,
			'sort' => 10,
			'status' => 1,
		],*/
	],
];