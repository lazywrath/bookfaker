<?php
namespace Application\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sport
 *
 * @ORM\Table(name="bf_sport")
 * @ORM\Entity(repositoryClass="SportRepository")
 */
class Sport extends AEntity
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
     * @ORM\ManyToMany(targetEntity="Championship", inversedBy="sports")
     * @ORM\JoinTable(name="bf_sport_championship",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_sport", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_championship", referencedColumnName="id")
     *   }
     * )
     */
    private $championships;

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
     * @return Sport
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
     * Add championship
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
}
