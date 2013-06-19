<?php
namespace Application\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Match
 *
 * @ORM\Table(name="bf_match")
 * @ORM\Entity(repositoryClass="MatchRepository")
 */
class Match
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
     * @var \Team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_team_one", referencedColumnName="id")
     * })
     */
    private $teamOne;

    /**
     * @var \Team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_team_two", referencedColumnName="id")
     * })
     */
    private $teamTwo;


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
     * Set idTeamOne
     *
     * @param \Team teamOne
     * @return Match
     */
    public function setTeamOne( $team = null)
    {
        $this->teamOne = $team;
    
        return $this;
    }

    /**
     * Get idTeamOne
     *
     * @return \Team 
     */
    public function getTeamOne()
    {
        return $this->teamOne;
    }

    /**
     * Set idTeamTwo
     *
     * @param \Team $teamTwo
     * @return Match
     */
    public function setTeamTwo($team = null)
    {
        $this->teamTwo = $team;
    
        return $this;
    }

    /**
     * Get teamTwo
     *
     * @return \Team 
     */
    public function getTeamTwo()
    {
        return $this->teamTwo;
    }
}
