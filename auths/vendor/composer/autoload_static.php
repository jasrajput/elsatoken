<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit13163acf9a41fa6bfae8007743f2640a
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'e69f7f6ee287b969198c3c9d6777bd38' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/bootstrap.php',
        '25072dd6e2470089de65ae7bf11d3109' => __DIR__ . '/..' . '/symfony/polyfill-php72/bootstrap.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        'f598d06aa772fa33d905e87be6398fb1' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/bootstrap.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        'decc78cc4436b1292c6c0d151b19445c' => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'phpseclib\\' => 10,
        ),
        'k' => 
        array (
            'kornrunner\\' => 11,
        ),
        'W' => 
        array (
            'Web3p\\RLP\\' => 10,
            'Web3p\\EthereumUtil\\' => 19,
            'Web3p\\EthereumTx\\' => 17,
            'Web3\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Php72\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Intl\\Normalizer\\' => 33,
            'Symfony\\Polyfill\\Intl\\Idn\\' => 26,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
        'E' => 
        array (
            'Elliptic\\' => 9,
        ),
        'C' => 
        array (
            'CoinbaseCommerce\\' => 17,
        ),
        'B' => 
        array (
            'BN\\' => 3,
            'BI\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'phpseclib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib',
        ),
        'kornrunner\\' => 
        array (
            0 => __DIR__ . '/..' . '/kornrunner/keccak/src',
        ),
        'Web3p\\RLP\\' => 
        array (
            0 => __DIR__ . '/..' . '/web3p/rlp/src',
        ),
        'Web3p\\EthereumUtil\\' => 
        array (
            0 => __DIR__ . '/..' . '/web3p/ethereum-util/src',
        ),
        'Web3p\\EthereumTx\\' => 
        array (
            0 => __DIR__ . '/..' . '/web3p/ethereum-tx/src',
        ),
        'Web3\\' => 
        array (
            0 => __DIR__ . '/..' . '/web3p/web3.php/src',
        ),
        'Symfony\\Polyfill\\Php72\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php72',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Intl\\Normalizer\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer',
        ),
        'Symfony\\Polyfill\\Intl\\Idn\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-idn',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Elliptic\\' => 
        array (
            0 => __DIR__ . '/..' . '/simplito/elliptic-php/lib',
        ),
        'CoinbaseCommerce\\' => 
        array (
            0 => __DIR__ . '/..' . '/coinbase/coinbase-commerce/src',
        ),
        'BN\\' => 
        array (
            0 => __DIR__ . '/..' . '/simplito/bn-php/lib',
        ),
        'BI\\' => 
        array (
            0 => __DIR__ . '/..' . '/simplito/bigint-wrapper-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Normalizer' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/Resources/stubs/Normalizer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit13163acf9a41fa6bfae8007743f2640a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit13163acf9a41fa6bfae8007743f2640a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit13163acf9a41fa6bfae8007743f2640a::$classMap;

        }, null, ClassLoader::class);
    }
}
