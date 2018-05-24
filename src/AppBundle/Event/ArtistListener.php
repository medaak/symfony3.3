<?php

namespace AppBundle\Event;

use Swift_Message;


class ArtistListener
{
    /** @var \Swift_Mailer  */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function onArtistCreated(ArtistEvent $event)
    {
        $message = Swift_Message::newInstance()
            ->setSubject('Wonderful Subject')
            ->setFrom('vocab75@gmail.com')
            ->setTo('vocab75@gmail.com')
            ->setBody('allo eded', 'text/html');
        // Send the message
        $this->mailer->send($message);
    }
}