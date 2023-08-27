<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitd5f19eeb3f8c2aa5865a2b4f8224c70b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitd5f19eeb3f8c2aa5865a2b4f8224c70b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitd5f19eeb3f8c2aa5865a2b4f8224c70b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitd5f19eeb3f8c2aa5865a2b4f8224c70b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
