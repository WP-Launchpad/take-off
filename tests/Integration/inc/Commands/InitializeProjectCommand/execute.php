<?php

namespace RocketLauncherTakeOff\Tests\Integration\inc\Commands\InitializeProjectCommand;

use RocketLauncherTakeOff\Tests\Integration\TestCase;

class Test_Execute extends TestCase
{
    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected($config, $expected) {
        foreach ($config['files'] as $path => $file) {
            $this->assertSame($file['exists'], $this->filesystem->exists($path));
            if($file['exists']) {
                $this->assertSame($file['content'], $this->filesystem->get_contents($path));
            }
        }

        $this->launch_app("initialize{$config['parameters']}");

        foreach ($expected['files'] as $path => $file) {
            $this->assertSame($file['exists'], $this->filesystem->exists($path));
            if($file['exists']) {
                $this->assertSame($file['content'], $this->filesystem->get_contents($path));
            }
        }
    }
}
