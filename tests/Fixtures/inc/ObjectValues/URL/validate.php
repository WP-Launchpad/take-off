<?php
return [
    'validValueShouldReturnSameValue' => [
        'config' => 'test',
        'expected' => true
    ],
    'invalidShouldRaiseException' => [
        'config' => 'https://test.test/test/',
        'expected' => false
    ]
];
