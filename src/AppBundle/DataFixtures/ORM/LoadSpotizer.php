<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Artist;
use AppBundle\Entity\Track;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

Class LoadSpotizer extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 artist! Bam!
        for ($i = 0; $i < 20; $i++) {

            $artist = new Artist();
            $artist->setName('artist ' . $i);
            $artist->setType('band');
            $artist->setPicture('picture' . $i . '.jpg');
            $artist->setGenre('rock');

            $track = new Track();
            $track->setTitle('title ' . $i);
            $track->setArtist($artist);

            $manager->persist($artist);
            $manager->persist($track);

        }
        $manager->flush();
    }
}