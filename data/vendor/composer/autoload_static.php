<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitde7b919d8fed55f0cbe7c63ab5205236
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SpotifyWebAPI\\' => 14,
        ),
        'R' => 
        array (
            'Rubizockt\\Data\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SpotifyWebAPI\\' => 
        array (
            0 => __DIR__ . '/..' . '/jwilsson/spotify-web-api-php/src',
        ),
        'Rubizockt\\Data\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitde7b919d8fed55f0cbe7c63ab5205236::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitde7b919d8fed55f0cbe7c63ab5205236::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitde7b919d8fed55f0cbe7c63ab5205236::$classMap;

        }, null, ClassLoader::class);
    }
}
