<?php

namespace AppBundle\Controller;

use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Default:index.html.twig', ['name' => $request->query->get('name')]);
    }

    public function sendAction()
    {
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['john@doe.com' => 'John Doe'])
            ->setTo(['medaakdev@gmail.com', 'other@domain.org' => 'A name'])
            ->setBody('Here is the message itself');
        // Send the message
        $this->get('mailer')->send($message);
    }
}