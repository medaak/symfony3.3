<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Artist;
use AppBundle\Entity\Playlist;
use AppBundle\Entity\Track;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

Class LoadSpotizer extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 3; $i++) {

            $playlist = new Playlist();
            $playlist->setName('Playlist n°' . $i);

            for ($y = 0; $y < 10; $y++) {

                $artist = new Artist();
                $artist->setName('artist '. $i . $y);
                $artist->setType('band');
                $artist->setPicture('picture'. $i . $y . '.jpg');
                $artist->setGenre('rock');

                $track = new Track();
                $track->setTitle('title '. $i . $y);
                $track->setArtist($artist);
                $track->setDuration(rand ( 250 , 550 ));

                $playlist->addTrack($track);

                $manager->persist($artist);
                $manager->persist($track);

            }

            $manager->persist($playlist);

        }
        $manager->flush();
    }
}