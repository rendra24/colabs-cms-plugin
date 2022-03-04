<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5730614777b06ba01c4769ecf3c535f2
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Colabs\\CmsPlugin\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Colabs\\CmsPlugin\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit5730614777b06ba01c4769ecf3c535f2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5730614777b06ba01c4769ecf3c535f2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5730614777b06ba01c4769ecf3c535f2::$classMap;

        }, null, ClassLoader::class);
    }
}