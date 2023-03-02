<?php

namespace RocketLauncherTakeOff\Entities;

use RocketLauncherTakeOff\ObjectValues\ConstantPrefix;
use RocketLauncherTakeOff\ObjectValues\Folder;
use RocketLauncherTakeOff\ObjectValues\HookPrefix;
use RocketLauncherTakeOff\ObjectValues\PS4Namespace;
use RocketLauncherTakeOff\ObjectValues\TranslationKey;
use RocketLauncherTakeOff\ObjectValues\URL;
use RocketLauncherTakeOff\ObjectValues\Version;
use RocketLauncherTakeOff\ObjectValues\WordPressKey;

class ProjectConfigurations
{
    /**
     * @var PS4Namespace
     */
    protected $namespace;

    /**
     * @var PS4Namespace
     */
    protected $test_namespace;

    /**
     * @var Folder
     */
    protected $code_folder;

    /**
     * @var Folder
     */
    protected $test_folder;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var URL
     */
    protected $url;

    /**
     * @var ConstantPrefix
     */
    protected $constant_prefix;

    /**
     * @var HookPrefix
     */
    protected $hook_prefix;

    /**
     * @var TranslationKey
     */
    protected $translation_key;

    /**
     * @var WordPressKey
     */
    protected $wordpress_key;

    /**
     * @var Version
     */
    protected $min_php;

    /**
     * @var Version
     */
    protected $min_wp;

    /**
     * @param PS4Namespace $namespace
     * @param PS4Namespace $test_namespace
     * @param Folder $code_folder
     * @param Folder $test_folder
     * @param string $name
     * @param string $description
     * @param string $author
     * @param URL $url
     * @param Version $min_php
     * @param Version $min_wp
     */
    public function __construct(PS4Namespace $namespace, PS4Namespace $test_namespace, Folder $code_folder, Folder $test_folder, string $name, string $description, string $author, URL $url, Version $min_php, Version $min_wp)
    {
        $this->namespace = $namespace;
        $this->test_namespace = $test_namespace;
        $this->code_folder = $code_folder;
        $this->test_folder = $test_folder;
        $this->name = $name;
        $this->description = $description;
        $this->author = $author;
        $this->url = $url;
        $this->min_php = $min_php;
        $this->min_wp = $min_wp;
    }

    /**
     * @return PS4Namespace
     */
    public function get_namespace(): PS4Namespace
    {
        return $this->namespace;
    }

    /**
     * @return PS4Namespace
     */
    public function get_test_namespace(): PS4Namespace
    {
        return $this->test_namespace;
    }

    /**
     * @return Folder
     */
    public function get_code_folder(): Folder
    {
        return $this->code_folder;
    }

    /**
     * @return Folder
     */
    public function get_test_folder(): Folder
    {
        return $this->test_folder;
    }

    /**
     * @return string
     */
    public function get_name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function get_description(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function get_author(): string
    {
        return $this->author;
    }

    /**
     * @return URL
     */
    public function get_url(): URL
    {
        return $this->url;
    }

    /**
     * @return ConstantPrefix
     */
    public function get_constant_prefix(): ConstantPrefix
    {
        return $this->constant_prefix;
    }

    /**
     * @return HookPrefix
     */
    public function get_hook_prefix(): HookPrefix
    {
        return $this->hook_prefix;
    }

    /**
     * @return TranslationKey
     */
    public function get_translation_key(): TranslationKey
    {
        return $this->translation_key;
    }

    /**
     * @return WordPressKey
     */
    public function get_wordpress_key(): WordPressKey
    {
        return $this->wordpress_key;
    }

    /**
     * @return Version
     */
    public function get_min_php(): Version
    {
        return $this->min_php;
    }

    /**
     * @return Version
     */
    public function get_min_wp(): Version
    {
        return $this->min_wp;
    }
}