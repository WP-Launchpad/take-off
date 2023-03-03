<?php

namespace RocketLauncherTakeOff\Services;

use League\Flysystem\Filesystem;
use RocketLauncherTakeOff\Entities\ProjectConfigurations;

class PrefixManager
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function replace(ProjectConfigurations $old_configurations, ProjectConfigurations $new_configurations) {

    }
}