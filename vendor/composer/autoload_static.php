<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2d3b7a38f89203753b185faaf3b7c282
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Medoo\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Medoo\\' => 
        array (
            0 => __DIR__ . '/..' . '/catfan/medoo/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2d3b7a38f89203753b185faaf3b7c282::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2d3b7a38f89203753b185faaf3b7c282::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}