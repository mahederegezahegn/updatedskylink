<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd5f19eeb3f8c2aa5865a2b4f8224c70b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd5f19eeb3f8c2aa5865a2b4f8224c70b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd5f19eeb3f8c2aa5865a2b4f8224c70b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd5f19eeb3f8c2aa5865a2b4f8224c70b::$classMap;

        }, null, ClassLoader::class);
    }
}
