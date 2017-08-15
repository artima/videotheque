<?php

/**
 * Created by PhpStorm.
 * User: Mitra
 * Date: 17/07/2017
 * Time: 11:54
 */
namespace MI\PlatformBundle\Email;

use MI\PlatformBundle\Entity\Film;

class ApplicationMailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendNewNotification()
    {
        $message = new \Swift_Message(
            'Mis à jour de film',
            'Vous avez reçu une nouvelle mise à jour.'
        );

        $message
            ->addTo('mitraizadi65@gmail.com')
            ->addFrom('admin@votresite.com')
        ;
        $this->mailer->send($message);
    }
}
