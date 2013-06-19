<?php
namespace Application\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="bf_team")
 * @ORM\Entity(repositoryClass="TeamRepository")
 */
class Team
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Championship", inversedBy="teams")
     * @ORM\JoinTable(name="bf_team_championship",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_team", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_championship", referencedColumnName="id")
     *   }
     * )
     */
    private $championships;

    /**
     * @var \Sport
     *
     * @ORM\ManyToOne(targetEntity="Sport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sport", referencedColumnName="id")
     * })
     */
    private $sport;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->championships = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Team
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
     * Add idChampionship
     *
     * @param \Championship $championship
     * @return Team
     */
    public function addChampionship( $championship)
    {
        $this->championships[] = $championship;
    
        return $this;
    }

    /**
     * Remove Championship
     *
     * @param Championship $championship
     */
    public function removeChampionship($championship)
    {
        $this->championships->removeElement($championship);
    }

    /**
     * Get Championships
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChampionships()
    {
        return $this->championships;
    }

    /**
     * Set Sport
     *
     * @param \Sport $Sport
     * @return Team
     */
    public function setSport( $sport = null)
    {
        $this->sport = $sport;
    
        return $this;
    }

    /**
     * Get sport
     *
     * @return \Sport 
     */
    public function getSport()
    {
        return $this->sport;
    }
}
