<?php

namespace RocketLauncherTakeOff\Services;

use League\Flysystem\Filesystem;
use RocketLauncherBuilder\Templating\Renderer;
use RocketLauncherTakeOff\Entities\ProjectConfigurations;

class PluginFileManager
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @param Filesystem $filesystem
     * @param Renderer $renderer
     */
    public function __construct(Filesystem $filesystem, Renderer $renderer)
    {
        $this->filesystem = $filesystem;
        $this->renderer = $renderer;
    }

    public function generate(ProjectConfigurations $old_configurations, ProjectConfigurations $new_configurations) {

    }
}