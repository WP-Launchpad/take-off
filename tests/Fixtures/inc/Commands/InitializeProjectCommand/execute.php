<?php
return [
    '' => [
        'config' => [
            'parameters' => '',
            'files' => [
                'inc/main.php' => [
                    'exists' => true,
                    'content' => file_get_contents(ROCKER_LAUNCHER_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/main.php')
                ],
                'inc/Plugin.php' => [
                    'exists' => true,
                    'content' => file_get_contents(ROCKER_LAUNCHER_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/Plugin.php')
                ],
                'inc/Engine/Test.php' => [
                    'exists' => true,
                    'content' =>  file_get_contents(ROCKER_LAUNCHER_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/Engine/Test.php')
                ],
                'rocket-launcher.php' => [
                    'exists' => true,
                    'content' => file_get_contents(ROCKER_LAUNCHER_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/rocket-launcher.php')
                ],
                'my-test-app.php' => [
                    'exists' => false,
                ],
                'composer.json' => [
                    'exists' => true,
                    'content' => file_get_contents(ROCKER_LAUNCHER_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/composer.json')
                ],
                'tests/Unit/bootstrap.php' => [
                    'exists' => true,
                    'content' => file_get_contents(ROCKER_LAUNCHER_TAKE_OFF_TESTS_FIXTURES_DIR . '/tests/Unit/bootstrap.php')
                ],
                'tests/Unit/TestCase.php' => [
                    'exists' => true,
                    'content' => file_get_contents(ROCKER_LAUNCHER_TAKE_OFF_TESTS_FIXTURES_DIR . '/tests/Unit/TestCase.php')
                ],
                'tests/Integration/bootstrap.php' => [
                    'exists' => true,
                    'content' => file_get_contents(ROCKER_LAUNCHER_TAKE_OFF_TESTS_FIXTURES_DIR . '/tests/Integration/bootstrap.php')
                ],
                'tests/Integration/TestCase.php' => [
                    'exists' => true,
                    'content' => file_get_contents(ROCKER_LAUNCHER_TAKE_OFF_TESTS_FIXTURES_DIR . '/tests/Integration/TestCase.php')
                ],
            ]
        ],
        'expected' => [
            'files' => [
                'inc/main.php' => [
                    'exists' => true,
                    'content' => file_get_contents(__DIR__ . '/files/inc/main.php')
                ],
                'inc/Plugin.php' => [
                    'exists' => true,
                    'content' => file_get_contents(__DIR__ . '/files/inc/Plugin.php')
                ],
                'inc/Engine/Test.php' => [
                    'exists' => true,
                    'content' =>  file_get_contents(__DIR__ . '/files/inc/Engine/Test.php')
                ],
                'rocket-launcher.php' => [
                    'exists' => false,
                ],
                'my-test-app.php' => [
                    'exists' => false,
                    'content' => file_get_contents(__DIR__ . '/files/my-test-app.php')
                ],
                'composer.json' => [
                    'exists' => true,
                    'content' => file_get_contents(__DIR__ . '/files/composer.json')
                ],
                'tests/Unit/bootstrap.php' => [
                    'exists' => true,
                    'content' => file_get_contents(__DIR__ . '/tests/Unit/bootstrap.php')
                ],
                'tests/Unit/TestCase.php' => [
                    'exists' => true,
                    'content' => file_get_contents(__DIR__ . '/tests/Unit/TestCase.php')
                ],
                'tests/Integration/bootstrap.php' => [
                    'exists' => true,
                    'content' => file_get_contents(__DIR__ . '/tests/Integration/bootstrap.php')
                ],
                'tests/Integration/TestCase.php' => [
                    'exists' => true,
                    'content' => file_get_contents(__DIR__ . '/tests/Integration/TestCase.php')
                ],
            ]
        ]
    ],
];
