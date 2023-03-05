<?php

namespace RocketLauncherTakeOff\Commands;

use Ahc\Cli\IO\Interactor;
use RocketLauncherBuilder\Commands\Command;
use RocketLauncherTakeOff\Entities\ProjectConfigurations;
use RocketLauncherTakeOff\ObjectValues\Folder;
use RocketLauncherTakeOff\ObjectValues\InvalidValue;
use RocketLauncherTakeOff\ObjectValues\URL;
use RocketLauncherTakeOff\ObjectValues\Version;
use RocketLauncherTakeOff\Services\NamespaceManager;
use RocketLauncherTakeOff\Services\PluginFileManager;
use RocketLauncherTakeOff\Services\PrefixManager;
use RocketLauncherTakeOff\Services\ProjectManager;

class InitializeProjectCommand extends Command
{

    /**
     * @var NamespaceManager
     */
    protected $namespace_manager;

    /**
     * @var PluginFileManager
     */
    protected $plugin_file_manager;

    /**
     * @var PrefixManager
     */
    protected $prefix_manager;

    /**
     * @var ProjectManager
     */
    protected $project_manager;

    public function __construct(NamespaceManager $namespace_manager, PluginFileManager $plugin_file_manager, PrefixManager $prefix_manager, ProjectManager $project_manager)
    {
        parent::__construct('initialize', 'Initialize the project');

        $this->namespace_manager = $namespace_manager;
        $this->plugin_file_manager = $plugin_file_manager;
        $this->prefix_manager = $prefix_manager;
        $this->project_manager = $project_manager;

        $this
            ->option('-n --name', 'Name from the project')
            ->option('-d --description', 'Description from the project')
            ->option('-a --author', 'Author from the project')
            ->option('-u --url', 'URL from the project')
            ->option('-p --php', 'Min PHP version from the project')
            ->option('-w --wp', 'Min WordPress version from the project')
            // Usage examples:
            ->usage(
            // append details or explanation of given example with ` ## ` so they will be uniformly aligned when shown
                '<bold>  $0 initialize</end> ## Initialize the project<eol/>' .
                '<bold>  $0 initialize</end> <comment>-n "My app" -d "My test app" -a Cyrille -u http://example.org -p 7.2 -w 6.0.1 </end> ## Initialize the project<eol/>'
            );
    }

    /**
     * Interacts with the user to get missing values.
     *
     * @param Interactor $io Interface to interact with the user.
     * @return void
     */
    public function interact(Interactor $io)
    {
        // Collect missing opts/args
        if (!$this->name) {
            $this->set('name', $io->prompt('Enter name from the project'));
        }
    }

    public function execute($name, $description, $author, $url, $php, $wp)
    {
        $io = $this->app()->io();

        $name =  trim($name, "'\"");

        $description = is_string($description) ? $description : '';
        $description =  trim($description, "'\"");

        $author = is_string($author) ? $author : '';
        $author =  trim($author, "'\"");

        if($url) {
            try {
                $url = new URL($url);
            } catch (InvalidValue $e) {
                $io->write($e->getMessage());
                return;
            }
        }

        if($php) {
            try {
                $php = new Version($php);
            } catch (InvalidValue $e) {
                $io->write($e->getMessage());
                return;
            }
        }

        if($wp) {
            try {
                $wp = new Version($wp);
            } catch (InvalidValue $e) {
                $io->write($e->getMessage());
                return;
            }
        }

        $code_folder = new Folder('inc/');
        $tests_folder = new Folder('tests/');

        $new_configurations = new ProjectConfigurations($code_folder, $tests_folder, $name, $description, $author, $url, $php, $wp);
        $old_configurations = new ProjectConfigurations($code_folder, $tests_folder, 'Rocket launcher', '', '');

        $this->namespace_manager->replace($old_configurations, $new_configurations);

        $this->prefix_manager->replace($old_configurations, $new_configurations);

        $this->project_manager->adapt($old_configurations, $new_configurations);

        $this->plugin_file_manager->generate($old_configurations, $new_configurations);

        $this->project_manager->reload();
    }
}
