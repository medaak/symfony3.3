<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('sec_to_min', array($this, 'secToMin')),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('playlist_duration', array($this, 'playlistDuration')),
        );
    }

    public function playlistDuration($tracks)
    {
        $sum = 0;
        foreach ($tracks as $track) {
            $sum += $track->getDuration();
        }

        return $sum;
    }

    public function secToMin($value)
    {

        return gmdate("H:i:s", $value);
    }
}