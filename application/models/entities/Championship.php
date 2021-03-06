<?php
namespace Application\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Championship
 *
 * @ORM\Table(name="bf_championship")
 * @ORM\Entity(repositoryClass="ChampionshipRepository")
 */
class Championship extends AEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Team", mappedBy="championships")
     */
    private $teams;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Sport", mappedBy="championships")
     */
    private $sports;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sports = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Championship
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
     * Add idTeam
     *
     * @param \Team $idTeam
     * @return Championship
     */
    public function addTeam( $team)
    {
        $this->teams[] = $team;
        
        $team->addChampionship($this);
    
        return $this;
    }

    /**
     * Remove team
     *
     * @param \Team $team
     */
    public function removeTeam($team)
    {
        $this->teams->removeElement($team);
    }

    /**
     * Get idTeam
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Add sport
     *
     * @param \Sport $sport
     * @return Championship
     */
    public function addSport( $sport)
    {
        $this->sports[] = $sport;
        
        $sport->addChampionship($this);
    
        return $this;
    }

    /**
     * Remove sport
     *
     * @param \Sport $sport
     */
    public function removeSport($sport)
    {
        $this->sports->removeElement($sport);
    }

    /**
     * Get sports
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSports()
    {
        return $this->sports;
    }
}
