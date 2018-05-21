<?php

namespace AppBundle\Repository;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Class TrackRepository
{
    public static $tracks = [
        [
            'id' => 2,
            'title' => 'Eversort',
            'artist' => 5,
        ],
        [
            'id' => 123,
            'title' => 'Everlong',
            'artist' => 1,
        ],
    ];

    private function find($id)
    {
        $key = array_search($id, array_column(self::$tracks, 'id'));

        if (false === $key) {
            throw new NotFoundHttpException('hello erreur');
        }

        return self::$tracks[$key];
    }

    private function findAll()
    {
        return self::$tracks;
    }
}