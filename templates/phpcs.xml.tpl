<?xml version="1.0"?>
<ruleset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="WP Rocket" xsi:noNamespaceSchemaLocation="vendor/squizlabs/php_codesniffer/phpcs.xsd">
    <description>The custom ruleset for Launchpad.</description>

    <!-- For help in understanding this file: https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-ruleset.xml -->
    <!-- For help in using PHPCS: https://github.com/squizlabs/PHP_CodeSniffer/wiki/Usage -->

    <!-- ** WHAT TO SCAN ** -->

    <file>.</file>
    <!-- Ignoring Files and Folders: https://github.com/squizlabs/PHP_CodeSniffer/wiki/Advanced-Usage#ignoring-files-and-folders -->
    <exclude-pattern>/tests/*</exclude-pattern>
    <exclude-pattern>/vendor/*</exclude-pattern>
    <exclude-pattern>/vendor-prefixed/*</exclude-pattern>
    <exclude-pattern>/node_modules/*</exclude-pattern>

    <!-- ** HOW TO SCAN ** -->

    <arg value="sp"/><!-- Show sniff and progress -->
    <arg name="colors"/><!-- Show results with colors -->
    <arg name="parallel" value="50"/><!-- Enables parallel processing when available for faster results. -->
    <arg name="extensions" value="php"/><!-- Limit to PHP files -->

    <!-- Rules: Check PHP version compatibility - see https://github.com/PHPCompatibility/PHPCompatibilityWP -->
    <rule ref="PHPCompatibility"/>
    {% if {{ has_php }} : %}
    <config name="testVersion" value="{{ php }}-"/>
    {% endif %}
    {% if {{ has_wp }} : %}
    <config name="minimum_supported_wp_version" value="{{ wp }}"/>
    {% endif %}

    <rule ref="WordPress">
        <exclude name="Generic.Functions.FunctionCallArgumentSpacing.TooMuchSpaceAfterComma"/>
        <exclude name="Generic.PHP.NoSilencedErrors.Discouraged"/>
        <exclude name="PEAR.Functions.FunctionCallSignature.Indent"/>
        <exclude name="Squiz.ControlStructures.ControlSignature.SpaceAfterCloseBrace"/>
        <exclude name="Squiz.Commenting.FileComment.Missing"/>
        <exclude name="Squiz.Commenting.FileComment.MissingPackageTag"/>
        <exclude name="Squiz.PHP.CommentedOutCode.Found"/>
        <exclude name="WordPress.Files.FileName.NotHyphenatedLowercase" />
        <exclude name="Generic.Arrays.DisallowShortArraySyntax" />
    </rule>
    <rule ref="WordPress.WP.I18n">
        <properties>
            <property name="text_domain" type="array" value="{{ translation_key }}" />
        </properties>
    </rule>
    <rule ref="WordPress.NamingConventions.PrefixAllGlobals">
        <properties>
            <property name="prefixes" type="array" value="{{ hook_prefix }},{{ namespace }}" />
        </properties>
    </rule>
    <rule ref="WordPress.Files.FileName">
        <properties>
            <property name="strict_class_file_names" value="false" />
        </properties>
    </rule>


    <rule ref="WordPress-Docs">
        <exclude name="Squiz.Commenting.FileComment.Missing"/>
        <exclude name="Squiz.Commenting.ClassComment.Missing"/>
    </rule>

    <!-- Rules: WordPress Coding Standards - see
        https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards
        WordPress-Extra includes WordPress-Core -->
    <rule ref="WordPress-Extra">
        <exclude name="Generic.Arrays.DisallowShortArraySyntax"/>
        <exclude name="WordPress.PHP.DisallowShortTernary.Found"/>
    </rule>

    <!-- Enforce short array syntax: `[]` in place of `array()`. -->
    <rule ref="Generic.Arrays.DisallowLongArraySyntax" />
</ruleset>
