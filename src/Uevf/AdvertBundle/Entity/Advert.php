<?php

namespace Uevf\AdvertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Advert
 *
 * @ORM\Table(name="adverts")
 * @ORM\Entity(repositoryClass="Uevf\AdvertBundle\Repository\AdvertRepository")
 */
class Advert
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modifyDate", type="datetime")
     */
    private $modifyDate;

    /**
     * @var text
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;


    /**
     * @var relation
     *
     * @ORM\ManyToOne(targetEntity="Uevf\UserBundle\Entity\Account");
     */
    private $author;


    /**
     * @var relation
     *
     * @ORM\ManyToOne(targetEntity="Uevf\AdvertBundle\Entity\AdvertTheme")
     */
    private $theme;

    /**
     * @var relation O-T-M
     *
     * @ORM\OneToMany(targetEntity="Uevf\AdvertBundle\Entity\AdvertImage",mappedBy="advert", cascade={"persist","remove"})
     */
    private $images;

    private $uploads;




// --------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    public function setUploads($uploads)
    {
        $this->uploads = $uploads;
    }

    public function getUploads()
    {
        return $this->uploads;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Advert
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set modifyDate
     *
     * @param \DateTime $modifyDate
     *
     * @return Advert
     */
    public function setModifyDate($modifyDate)
    {
        $this->modifyDate = $modifyDate;

        return $this;
    }

    /**
     * Get modifyDate
     *
     * @return \DateTime
     */
    public function getModifyDate()
    {
        return $this->modifyDate;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Advert
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set author
     *
     * @param \Uevf\UserBundle\Entity\Account $author
     *
     * @return Advert
     */
    public function setAuthor(\Uevf\UserBundle\Entity\Account $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Uevf\UserBundle\Entity\Account
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set theme
     *
     * @param \Uevf\AdvertBundle\Entity\AdvertTheme $theme
     *
     * @return Advert
     */
    public function setTheme(\Uevf\AdvertBundle\Entity\AdvertTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Uevf\AdvertBundle\Entity\AdvertTheme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Add image
     *
     * @param \Uevf\AdvertBundle\Entity\AdvertImage $image
     *
     * @return Advert
     */
    public function addImage(\Uevf\AdvertBundle\Entity\AdvertImage $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Uevf\AdvertBundle\Entity\AdvertImage $image
     */
    public function removeImage(\Uevf\AdvertBundle\Entity\AdvertImage $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
