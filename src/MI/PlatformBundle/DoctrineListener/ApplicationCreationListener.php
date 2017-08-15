<?php

/**
 * Created by PhpStorm.
 * User: Mitra
 * Date: 17/07/2017
 * Time: 12:44
 */
namespace MI\PlatformBundle\DoctrineListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use MI\PlatformBundle\Email\ApplicationMailer;
use MI\PlatformBundle\Entity\Film;

class ApplicationCreationListener
{
    /**
     * @var ApplicationMailer
     */
    private $applicationMailer;

    public function __construct(ApplicationMailer $applicationMailer)
    {
        $this->applicationMailer = $applicationMailer;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Film) {
            return;
        }

        $this->applicationMailer->sendNewNotification();
    }
}
