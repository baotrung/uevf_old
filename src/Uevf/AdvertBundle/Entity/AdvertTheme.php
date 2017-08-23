<?php

namespace Uevf\AdvertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * advertTheme
 *
 * @ORM\Table(name="advert_theme")
 * @ORM\Entity(repositoryClass="Uevf\AdvertBundle\Repository\AdvertThemeRepository")
 */
class AdvertTheme
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
     * @ORM\Column(name="theme", type="string", length=255)
     */
    private $theme;


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
     * Set theme
     *
     * @param string $theme
     *
     * @return advertTheme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }
}
