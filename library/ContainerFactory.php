<?php namespace DanGreaves\Flickbook;

use Pimple\Container;
use DanGreaves\Flickbook\Flickr;
use Aura\Html\HelperLocatorFactory;

/**
 * Factory for generating a Pimple DI container instance.
 *
 * @author Dan Greaves <dan@dangreaves.com>
 */
class ContainerFactory
{
    /**
     * Generate a new container instance.
     * 
     * @param  array $config
     * @return Pimple\Container
     */
    public static function make($config)
    {
        $container = new Container;

        foreach ($config as $key => $value) {
            $container[$key] = $value;
        }

        $container['flickr.api'] = function ($c) {
            return new Flickr\Api($c['flickr_key'], $c['flickr_secret']);
        };

        $container['escaper'] = function ($c) {
            return (new HelperLocatorFactory)->newInstance();
        };

        return $container;
    }
}
