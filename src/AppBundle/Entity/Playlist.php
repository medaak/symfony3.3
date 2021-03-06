<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Playlist
 *
 * @ORM\Table(name="playlist")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlaylistRepository")
 */
class Playlist
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @ORM\ManyToMany(targetEntity="Track", inversedBy="playlists")
     */
    private $tracks;

    public function __construct(){
        $this->tracks = new ArrayCollection();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Playlist
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add track.
     *
     * @param \AppBundle\Entity\Track $track
     *
     * @return Playlist
     */
    public function addTrack(\AppBundle\Entity\Track $track)
    {
        $track->addPlaylist($this);
        $this->tracks[] = $track;

        return $this;
    }

    /**
     * Remove track.
     *
     * @param \AppBundle\Entity\Track $track
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTrack(\AppBundle\Entity\Track $track)
    {
        $track->removePlaylist($this);
        return $this->tracks->removeElement($track);
    }

    /**
     * Get tracks.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTracks()
    {
        return $this->tracks;
    }
}
