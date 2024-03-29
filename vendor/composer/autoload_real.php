<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb72003fb4704e292bcd60a8244fe1107
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

        spl_autoload_register(array('ComposerAutoloaderInitb72003fb4704e292bcd60a8244fe1107', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb72003fb4704e292bcd60a8244fe1107', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb72003fb4704e292bcd60a8244fe1107::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
