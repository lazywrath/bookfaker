<?php

namespace Application\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bailout
 *
 * @ORM\Table(name="bf_bailout")
 * @ORM\Entity(repositoryClass="BailoutRepository")
 */
class Bailout
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="amout", type="smallint", nullable=false)
     */
    private $amout;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $user;


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
     * Set amout
     *
     * @param integer $amout
     * @return Bailout
     */
    public function setAmout($amout)
    {
        $this->amout = $amout;
    
        return $this;
    }

    /**
     * Get amout
     *
     * @return integer 
     */
    public function getAmout()
    {
        return $this->amout;
    }

    public function getUser() {
        return $this->user;
    }
    
    /**
     * 
     * @param type $user
     */
    public function setUser($user) {
        
        $this->user = $user;
        
        return $this;
    }


}
