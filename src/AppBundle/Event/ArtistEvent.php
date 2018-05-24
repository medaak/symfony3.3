<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use AppBundle\Entity\Artist;

/**
 * Class ArtistEvent
 * @package AppBundle\Event
 */
class ArtistEvent extends Event
{
    /** @var Artist */
    private $artist;

    /**
     * @param Artist $artist
     */
    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    public function getArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }
}