<?php

/**
 * Created by PhpStorm.
 * User: Mitra
 * Date: 17/07/2017
 * Time: 12:08
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="MI\PlatformBundle\Entity\Film", mappedBy="user")
     */
    private $film;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set film
     *
     * @param \MI\PlatformBundle\Entity\Film $film
     *
     * @return User
     */
    public function setFilm(\MI\PlatformBundle\Entity\Film $film)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \MI\PlatformBundle\Entity\Film
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Add film
     *
     * @param \MI\PlatformBundle\Entity\Film $film
     *
     * @return User
     */
    public function addFilm(\MI\PlatformBundle\Entity\Film $film)
    {
        $this->film[] = $film;

        return $this;
    }

    /**
     * Remove film
     *
     * @param \MI\PlatformBundle\Entity\Film $film
     */
    public function removeFilm(\MI\PlatformBundle\Entity\Film $film)
    {
        $this->film->removeElement($film);
    }
}
