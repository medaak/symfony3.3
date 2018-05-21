<?php

namespace AppBundle\Repository;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Class ArtistRepository
{
    public static $artists = [
        [
            'id' => 1,
            'name' => 'Foo fighters',
            'type' => 'band', // solo
            'picture' => 'http://rockmetalmag.fr/wp-content/uploads/2014/05/foo_fighters_52847.jpg',
            'genre' => 'rock',
        ],
        [
            'id' => 5,
            'name' => 'Claude François',
            'type' => 'band', // solo
            'picture' => 'http://rockmetalmag.fr/wp-content/uploads/2014/05/foo_fighters_52847.jpg',
            'genre' => 'variétés',
        ],
    ];

    public function find($id)
    {
        $key = array_search($id, array_column(self::$artists, 'id'));

        if (false === $key) {
            throw new NotFoundHttpException('hello erreur');
        }

        return self::$artists[$key];
    }

    public function findAll()
    {
        return self::$artists;
    }
}