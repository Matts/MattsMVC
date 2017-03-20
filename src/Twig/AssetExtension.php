<?php
namespace Twig;
use Twig_Extension;

/**
 * MattsMVC
 *
 * Copyright (c) 2017 Matthew Smeets
 *
 * Created By: Matt
 * Date: 3/20/2017
 */
class AssetExtension extends Twig_Extension
{
    private $base;
    public function __construct($base)
    {
        $this->base = $base;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('assets', "getAsset")
        );
    }

    public function getAsset($url)
    {

        return $this->base . $url;
    }
}