<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Track
 *
 * @ORM\Table(name="track")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrackRepository")
 */
class Track
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Artist", inversedBy="tracks")
     */
    private $artist;


    /**
     * @ORM\ManyToMany(targetEntity="Playlist", mappedBy="tracks")
     */
    private $playlists;

    public function __construct(){
        $this->artist = new ArrayCollection();
        $this->playlists = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }



    /**
     * Set artist
     *
     * @param \AppBundle\Entity\Artist $artist
     *
     * @return Track
     */
    public function setArtist(\AppBundle\Entity\Artist $artist = null)
    {
        $this->artist = $artist;
        $artist->addTrack($this);

        return $this;
    }

    /**
     * Get artist
     *
     * @return \AppBundle\Entity\Artist
     */
    public function getArtist()
    {
        return $this->artist;
    }
}
