<?php

namespace LaunchpadTakeOff\Tests\Unit\inc\Services\NamespaceManager;

use League\Flysystem\Filesystem;
use Mockery;
use LaunchpadTakeOff\Entities\ProjectConfigurations;
use LaunchpadTakeOff\Services\NamespaceManager;
use RocketLauncherTakeOff\Tests\Unit\TestCase;

class Test_Replace extends TestCase
{
    protected $filesystem;
    protected $namespace_manager;

    protected $old_config;
    protected $new_config;

    protected function setUp(): void
    {
        parent::setUp();
        $this->filesystem = Mockery::mock(Filesystem::class);
        $this->new_config = Mockery::mock(ProjectConfigurations::class);
        $this->old_config = Mockery::mock(ProjectConfigurations::class);
        $this->namespace_manager = new NamespaceManager($this->filesystem);
    }

    /**
     * @dataProvider configTestData
     */
    public function testTestDoAsExpected($config, $expected) {
           $this->old_config->expects()->get_namespace()->andReturn($config['old_namespace']);
           $this->old_config->expects()->get_test_namespace()->andReturn($config['old_test_namespace']);
           $this->old_config->expects()->get_code_folder()->andReturn($config['old_code_folder']);
           $this->old_config->expects()->get_test_folder()->andReturn($config['old_test_folder']);
           $this->new_config->expects()->get_namespace()->andReturn($config['new_namespace']);
           $this->new_config->expects()->get_test_namespace()->andReturn($config['new_test_namespace']);

           $this->filesystem->expects()->twice()->listFiles($expected['old_code_folder_path'], true)->andReturn($config['files']);
           $this->filesystem->expects()->listFiles($expected['old_test_folder_path'], true)->andReturn($config['files']);

           foreach ($expected['files'] as $file) {
               $this->filesystem->expects()->read($file['path'])->andReturn($config['files_content'][$file['path']]);
               $this->filesystem->expects()->update($file['path'], $file['content']);
           }

           $this->namespace_manager->replace($this->old_config, $this->new_config);
    }
}
