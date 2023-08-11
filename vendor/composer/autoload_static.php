<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb6adf6d20fae543a560d5ab12a17feda
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Paymongo\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Paymongo\\' => 
        array (
            0 => __DIR__ . '/..' . '/paymongo/paymongo-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb6adf6d20fae543a560d5ab12a17feda::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb6adf6d20fae543a560d5ab12a17feda::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb6adf6d20fae543a560d5ab12a17feda::$classMap;

        }, null, ClassLoader::class);
    }
}
