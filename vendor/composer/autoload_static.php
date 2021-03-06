<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite9ea788e738e292e503e0762e6d596f8
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite9ea788e738e292e503e0762e6d596f8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite9ea788e738e292e503e0762e6d596f8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
