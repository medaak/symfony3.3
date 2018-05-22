<?php
/**
 * Created by PhpStorm.
 * User: fsalles
 * Date: 24/01/17
 * Time: 17:12
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Track;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TrackController extends Controller
{

    public function indexAction()
    {
        $tracks = $this->getDoctrine()->getRepository(Track::class)->findAll();
        return $this->render('AppBundle:Track:index.html.twig', ['tracks' => $tracks]);
    }

    public function showAction(Request $request, $id)
    {
        $track = $this->getDoctrine()->getRepository(Track::class)->find($id);
        dump($track);
        return $this->render('AppBundle:Track:show.html.twig', ['track' => $track]);
    }

    public function showJsonAction($id)
    {
        $track = $this->find($id);

        return new JsonResponse($track);
    }

    public function sessionAction($id, Request $request)
    {
        $request->getSession()->set('track', $this->find($id));

        return $this->redirectToRoute('app_track_session_show');
    }

    public function sessionShowAction(Request $request)
    {
        return $this->render('AppBundle:Track:show.html.twig', ['track' => $request->getSession()->get('track')]);
    }

}
