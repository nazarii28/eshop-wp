<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4d79f308bec337e6097b38279d3f0c26
{
    public static $files = array (
        '8b8aa66d2a1b65e8ea48d816f368e326' => __DIR__ . '/..' . '/cmb2/cmb2/init.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'WCCSO_Metabox' => __DIR__ . '/..' . '/pablo-pacheco/wc-custom-settings-options/src/class-wccso-metabox.php',
        'WCCSO_Singleton' => __DIR__ . '/..' . '/pablo-pacheco/wc-custom-settings-options/src/class-wccso-singleton.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit4d79f308bec337e6097b38279d3f0c26::$classMap;

        }, null, ClassLoader::class);
    }
}