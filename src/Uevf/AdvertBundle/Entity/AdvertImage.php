<?php

namespace Uevf\AdvertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdvertImage
 *
 * @ORM\Table(name="advert_image")
 * @ORM\Entity(repositoryClass="Uevf\AdvertBundle\Repository\AdvertImageRepository")
 */
class AdvertImage
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @var relation M-T-O
     *
     * @ORM\ManyToOne(targetEntity="Uevf\AdvertBundle\Entity\Advert", inversedBy="images")
     */
    private $advert;


    // -------------------------------------------------------------------------------------------------------------------------------------
    public function upload($upload,$advert)
    {
        if (null === $upload) {
            return;
        }
        $name = $upload->getClientOriginalName() . sha1(uniqid(mt_rand(), true)) . '.' . $upload->guessExtension();
        $upload->move($this->getUploadRootDir(), $name);
        $this->advert = $advert;
        $this->name = $name;
        $this->url = $this->getUploadDir().'/'.$name;
        $this->alt = "img-advert";
    }

    public function getUploadDir()
    {
        return 'uploads/Advert/img';
    }

    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    // -------------------------------------------------------------------------------------------------------------------------------------
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
     * Set name
     *
     * @param string $name
     *
     * @return AdvertImage
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return AdvertImage
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return AdvertImage
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }


    /**
     * Set advert
     *
     * @param \Uevf\AdvertBundle\Entity\Advert $advert
     *
     * @return AdvertImage
     */
    public function setAdvert(\Uevf\AdvertBundle\Entity\Advert $advert = null)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \Uevf\AdvertBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }
}
