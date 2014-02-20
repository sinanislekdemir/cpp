<?php

interface ProviderApi
{
    public function search($keyword);
}

class GTSProvider implements ProviderApi
{
    public function search($keyword)
    {
        echo "searching gts: $keyword \n";
    }
}

class MIKIProvider implements ProviderApi
{
    public function search($keyword)
    {
        echo "searching miki: $keyword \n";
    }
}

class ProviderFactory 
{
    private static $dictionary;

    public static function init()
    {
        self::$dictionary = array(
            'gts' => new GTSProvider(),
            'miki' => new MIKIProvider(),
        );
    }

    public static function GetApi($param = 'gts')
    {
        return self::$dictionary[$param];
    }
}

ProviderFactory::init();

$keyword = 'sinan';
$gts = ProviderFactory::GetApi('gts');
$gts->search($keyword);

/**
 * Benzer kullanım : kredi kartı ödemesi vb
 */
