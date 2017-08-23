<?php

namespace Uevf\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseAccount;

/**
 * Account
 *
 * @ORM\Table(name="accounts")
 * @ORM\Entity(repositoryClass="Uevf\UserBundle\Repository\AccountRepository")
 */
 class Account extends BaseAccount
 {
     /**
      * @var int
      *
      * @ORM\Column(name="id", type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
     protected  $id;

     /**
      * @ORM\ManyToOne(targetEntity="Uevf\UserBundle\Entity\User", cascade={"persist"});
      */
     protected  $user;



     /**
      * @ORM\OneToOne(targetEntity="Uevf\UserBundle\Entity\AccountImage", cascade={"persist"});
      */
     protected  $avatar;

     /**
     * @Assert\Regex(
     *  pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/",
     *  message="Le mot de passe doit contenir entre 8 et 16 caractères alphanumériques dont une majuscule, une minuscule et un chiffre."
     * )
     */
     protected $password;

     public function __construct()
     {
        parent::__construct();
        $this->roles=array('ROLE_USER');
     }

    /**
     * Set user
     *
     * @param \Uevf\UserBundle\Entity\User $user
     *
     * @return Account
     */
    public function setUser(\Uevf\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Uevf\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set avatar
     *
     * @param \Uevf\UserBundle\Entity\AccountImage $avatar
     *
     * @return Account
     */
    public function setAvatar(\Uevf\UserBundle\Entity\AccountImage $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \Uevf\UserBundle\Entity\AccountImage
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}
