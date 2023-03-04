<?php

namespace RocketLauncherTakeOff\Services;

use League\Flysystem\Filesystem;
use RocketLauncherTakeOff\Entities\ProjectConfigurations;
use RocketLauncherTakeOff\ObjectValues\Folder;
use RocketLauncherTakeOff\ObjectValues\PS4Namespace;

class NamespaceManager
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
        $code_folder = $old_configurations->get_code_folder();
        $test_folder = $old_configurations->get_test_folder();
        $this->replace_namespace_folder($code_folder, $old_configurations->get_namespace(), $new_configurations->get_namespace());
        $this->replace_namespace_folder($test_folder, $old_configurations->get_test_namespace(), $new_configurations->get_test_namespace());
        $this->replace_namespace_folder($test_folder, $old_configurations->get_namespace(), $new_configurations->get_namespace());
    }

    protected function replace_namespace_folder(Folder $folder, PS4Namespace $old_namespace, PS4Namespace $new_namespace) {
        $files = $this->filesystem->listFiles($folder->get_value(), true);
        foreach ($files as $file) {
            $content = $this->filesystem->read($file);
            $content = $this->replace_namespace_content($content, $old_namespace, $new_namespace);
            $this->filesystem->update($file, $content);
        }
    }

    protected function replace_namespace_content(string $content, PS4Namespace $old_namespace, PS4Namespace $new_namespace) {
        $old_namespace = $old_namespace->get_value();
        $new_namespace = $new_namespace->get_value();
        $content = preg_replace("/namespace $old_namespace/", "namespace $new_namespace", $content);
        return preg_replace("/use $old_namespace\\\\/", "use $new_namespace\\\\", $content);
    }
}