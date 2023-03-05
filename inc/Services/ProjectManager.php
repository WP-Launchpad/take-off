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

    const PROJECT_FILE = 'composer.json';

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function adapt(ProjectConfigurations $old_configurations, ProjectConfigurations $new_configurations) {

        $old_namespace = $old_configurations->get_namespace()->get_value() . '\\';
        $new_namespace = $new_configurations->get_namespace()->get_value() . '\\';

        $old_test_namespace = $old_configurations->get_namespace()->get_value() . '\\';
        $new_test_namespace = $new_configurations->get_namespace()->get_value() . '\\';

        $content = $this->filesystem->read(self::PROJECT_FILE);

        $json = json_decode($content, true);

        if( ! $json) {
            return;
        }

        if( key_exists('type', $json)) {
            $json['type'] = 'wordpress-plugin';
        }

        if (key_exists('extra', $json) && key_exists('mozart', $json['extra']) || key_exists('dep_namespace', $json['extra']['mozart'])) {
            $json['extra']['mozart']['dep_namespace'] = $new_configurations->get_namespace()->get_value() . '\\Dependencies\\';
        }
        if(key_exists('extra', $json) && key_exists('mozart', $json['extra']) || key_exists('classmap_prefix', $json['extra']['mozart'])) {
            $json['extra']['mozart']['classmap_prefix'] = $new_configurations->get_namespace()->get_value();
        }

        if(key_exists('autoload', $json) && key_exists('psr-4', $json['autoload']) && key_exists($old_namespace, $json['autoload']['psr-4'])) {
            $json['autoload']['psr-4'][$new_namespace] = $json['autoload']['psr-4'][$old_namespace];
            unset($json['autoload']['psr-4'][$old_namespace]);
        }

        if(key_exists('autoload', $json) && key_exists('psr-4', $json['autoload']) && key_exists($old_test_namespace, $json['autoload']['psr-4'])) {
            $json['autoload']['psr-4'][$new_test_namespace] = $json['autoload']['psr-4'][$old_test_namespace];
            unset($json['autoload']['psr-4'][$old_test_namespace]);
        }

        if(key_exists('require-dev', $json) && key_exists('crochetfeve0251/rocket-launcher-take-off', $json['require-dev'])) {
            unset($json['require-dev']['crochetfeve0251/rocket-launcher-take-off']);
        }

        $content = json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) . "\n";

        $this->filesystem->update(self::PROJECT_FILE, $content);
    }

    public function reload() {

    }
}
