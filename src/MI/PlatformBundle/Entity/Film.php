<?php

namespace MI\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Film
 *
 * @ORM\Table(name="film")
 * @ORM\Entity(repositoryClass="MI\PlatformBundle\Repository\FilmRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Film
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_ajout", type="datetime")
     *
     */
    private $date;
    /**
     * @var string
     * @Assert\Length(
     *      min = 10,minMessage = "Le titre doit avoir au moins {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity="MI\PlatformBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="MI\PlatformBundle\Entity\Category", cascade={"persist"})
     * @ORM\JoinTable(name="mi_film_category")
     */
    private $categories;

    /**
     * @ORM\Column(name="nb_film", type="integer")
     */
    private $nbFilm = 0;

    /**
     * @var \DateTime
     * @ORM\column(name="update_at", type="datetime", nullable=true)
     */
    private $updatAt;


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    public function __construct()
    {
        $this->categories   = new ArrayCollection();
        $this->date = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Film
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Film
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Film
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set image
     *
     * @param \MI\PlatformBundle\Entity\Image $image
     *
     * @return Film
     */
    public function setImage(\MI\PlatformBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MI\PlatformBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add category
     *
     * @param \MI\PlatformBundle\Entity\Categorie $category
     *
     * @return Film
     */
    public function addCategory(\MI\PlatformBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \MI\PlatformBundle\Entity\Categorie $category
     */
    public function removeCategory(\MI\PlatformBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     *
     * @ORM\PrePersist
     */
    public function increaseFilm()
    {
        $this->nbFilm ++;
    }

    /**
     *
     * @ORM\PreRemove
     */
    public function decreaseFilm()
    {
        $this->nbFilm --;
    }

    /**
     * Set nbFilm
     *
     * @param integer $nbFilm
     *
     * @return Film
     */
    public function setNbFilm($nbFilm)
    {
        $this->nbFilm = $nbFilm;

        return $this;
    }

    /**
     * Get nbFilm
     *
     * @return integer
     */
    public function getNbFilm()
    {
        return $this->nbFilm;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Film
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Film
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Film
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set updatAt
     *
     * @param \DateTime $updatAt
     *
     * @return Film
     */
    public function setUpdatAt($updatAt)
    {
        $this->updatAt = $updatAt;

        return $this;
    }

    /**
     * Get updatAt
     *
     * @return \DateTime
     */
    public function getUpdatAt()
    {
        return $this->updatAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setUpdatAt(new \DateTime());
    }
}
