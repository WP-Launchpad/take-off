<?php

namespace RocketLauncherTakeOff;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use RocketLauncherBuilder\App;
use RocketLauncherBuilder\Entities\Configurations;
use RocketLauncherBuilder\ServiceProviders\ServiceProviderInterface;
use RocketLauncherBuilder\Templating\Renderer;
use RocketLauncherTakeOff\Commands\InitializeProjectCommand;
use RocketLauncherTakeOff\Services\NamespaceManager;
use RocketLauncherTakeOff\Services\PluginFileManager;
use RocketLauncherTakeOff\Services\PrefixManager;
use RocketLauncherTakeOff\Services\ProjectManager;

class ServiceProvider implements ServiceProviderInterface
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
     * @var Renderer
     */
    protected $renderer;

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

        $adapter = new Local(
        // Determine root directory
            __DIR__ . '/../'
        );

        // The FilesystemOperator
        $template_filesystem = new Filesystem($adapter);

        $this->renderer = new Renderer($template_filesystem, '/templates/');
    }


    /**
     * @inheritDoc
     */
    public function attach_commands(App $app): App
    {
        $namespace_manager = new NamespaceManager($this->filesystem);
        $plugin_file_manager = new PluginFileManager($this->filesystem, $this->renderer);
        $prefix_manager = new PrefixManager($this->filesystem);
        $project_manager = new ProjectManager($this->filesystem);
        $app->add(new InitializeProjectCommand($this->configs, $namespace_manager, $plugin_file_manager, $prefix_manager, $project_manager));
        return $app;
    }
}
