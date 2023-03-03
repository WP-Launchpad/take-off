<?php

namespace RocketLauncherTakeOff\Tests\inc\Unit\inc\ObjectValues\HookPrefix;

use RocketLauncherTakeOff\ObjectValues\HookPrefix;
use RocketLauncherTakeOff\ObjectValues\InvalidValue;
use RocketLauncherTakeOff\Tests\Unit\TestCase;

class Test_Validate extends TestCase
{
    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected($config, $expected) {
        if( ! $expected ) {
            $this->expectException(InvalidValue::class);
        }
        $object_value = new HookPrefix($config);
        $this->assertSame($config, $object_value->get_value());
    }
}
