<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit335de6cc774a967ea0156fbe8526fd40
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TaskTracker\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TaskTracker\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit335de6cc774a967ea0156fbe8526fd40::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit335de6cc774a967ea0156fbe8526fd40::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit335de6cc774a967ea0156fbe8526fd40::$classMap;

        }, null, ClassLoader::class);
    }
}
