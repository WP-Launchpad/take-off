<?php

namespace RocketLauncherTakeOff;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use RocketLauncherBuilder\App;
use RocketLauncherBuilder\Entities\Configurations;
use RocketLauncherBuilder\Templating\Renderer;

class ServiceProvider implements \RocketLauncherBuilder\ServiceProviders\ServiceProviderInterface
{
    /**
     * Interacts with the filesystem.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Configuration from the project.
     *
     * @var Configurations
     */
    protected $configs;
    /**
     * Instantiate the class.
     *
     * @param Configurations $configs configuration from the project.
     * @param Filesystem $filesystem Interacts with the filesystem.
     * @param string $app_dir base directory from the cli.
     */
    public function __construct(Configurations $configs, Filesystem $filesystem, string $app_dir)
    {
        $this->configs = $configs;
        $this->filesystem = $filesystem;
    }


    /**
     * @inheritDoc
     */
    public function attach_commands(App $app): App
    {

        return $app;
    }
}
