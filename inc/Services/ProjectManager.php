<?php

namespace RocketLauncherTakeOff\Services;

use League\Flysystem\Filesystem;
use RocketLauncherTakeOff\Entities\ProjectConfigurations;

class ProjectManager
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

    public function adapt(ProjectConfigurations $old_configurations, ProjectConfigurations $new_configurations) {

    }

    public function reload() {

    }
}
