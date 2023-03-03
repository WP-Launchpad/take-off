<?php

namespace RocketLauncherTakeOff\Tests\inc\Unit\inc\ObjectValues\Version;

use RocketLauncherTakeOff\ObjectValues\InvalidValue;
use RocketLauncherTakeOff\ObjectValues\Version;
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
        $object_value = new Version($config);
        $this->assertSame($config, $object_value->get_value());
    }
}
