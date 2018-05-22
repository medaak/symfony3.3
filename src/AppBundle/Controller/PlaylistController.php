<?php
/**
 * Created by PhpStorm.
 * User: fsalles
 * Date: 24/01/17
 * Time: 17:12
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Playlist;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PlaylistController extends Controller
{

    public function indexAction()
    {
        $playlists = $this->getDoctrine()->getRepository(Playlist::class)->findAll();
        return $this->render('AppBundle:Playlist:index.html.twig', ['playlists' => $playlists]);
    }

    public function showAction(Request $request, $id)
    {
        $playlist = $this->getDoctrine()->getRepository(Playlist::class)->find($id);
        return $this->render('AppBundle:Playlist:show.html.twig', ['playlist' => $playlist]);
    }

}
