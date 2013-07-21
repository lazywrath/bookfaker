<?php
namespace Application\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="bf_commande")
 * @ORM\Entity(repositoryClass="CommandeRepository")
 */
class Commande extends AEntity
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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     *
     */
    private $user;

    /**
     * @var \Gift
     *
     * @ORM\ManyToOne(targetEntity="Gift")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gift", referencedColumnName="id")
     * })
     *
     */
    private $gift;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     *
     */
    private $date;
    

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
     * Set Name
     *
     * @param \user user
     * @return user
     */
    public function setUser( $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \user 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set gift
     *
     * @param \gift gift
     * @return gift
     */
    public function setgift( $gift = null)
    {
        $this->gift = $gift;
    
        return $this;
    }

    /**
     * Get gift
     *
     * @return \gift 
     */
    public function getgift()
    {
        return $this->gift;
    }

    /**
     * Set date
     *
     * @param \date $date
     * @return date
     */
    public function setdate($date = null)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \date 
     */
    public function getdate()
    {
        return $this->date;
    }
    
    
}
