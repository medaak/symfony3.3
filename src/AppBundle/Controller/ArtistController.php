<?php
/**
 * Created by PhpStorm.
 * User: fsalles
 * Date: 24/01/17
 * Time: 17:11
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Artist;
use AppBundle\Form\Type\ArtistType;
use AppBundle\Event\ArtistEvent;
use AppBundle\Event\ArtistEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ArtistController extends Controller
{


    public function indexAction()
    {
        /*        $myContainer = $this->get('app.artist');
                return $this->render('AppBundle:Artist:index.html.twig', ['artists' => $myContainer->findAll()]);*/
        $artists = $this->getDoctrine()->getRepository(Artist::class)->findAll();
        return $this->render('AppBundle:Artist:index.html.twig', ['artists' => $artists]);
    }

    public function showAction($id)
    {

        $artist = $this->getDoctrine()->getRepository(Artist::class)->find($id);
        return $this->render('AppBundle:Artist:show.html.twig', ['artist' => $artist]);
    }

    public function showJsonAction($id)
    {
        $myContainer = $this->get('app.artist');
        $artist = $myContainer->find($id);

        return new JsonResponse($artist);
    }

    public function createAction(Request $request)
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->get('doctrine.orm.entity_manager');
            $entityManager->persist($artist);
            $entityManager->flush();

            $event= new ArtistEvent($artist);
            $this->get('event_dispatcher')->dispatch(ArtistEvents::ARTIST_CREATED, $event);


            return $this->redirect($this->generateUrl('app_artist_index'));
        }

        return $this->render('AppBundle:Artist:new.html.twig', [
            'form'=>$form->createView(),
        ]);

    }

    public function updateAction(Request $request, $id){
        $artist = $this->getDoctrine()->getRepository(Artist::class)->find($id);
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->get('doctrine.orm.entity_manager');
            $entityManager->persist($artist);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('app_artist_index'));
        }

        return $this->render('AppBundle:Artist:update.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

}
