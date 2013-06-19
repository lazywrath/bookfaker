<?php
namespace Application\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bet
 *
 * @ORM\Table(name="bf_bet")
 * @ORM\Entity(repositoryClass="BetRepository")
 */
class Bet
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
     * @var float
     *
     * @ORM\Column(name="odds", type="float", nullable=false)
     */
    private $odds;

    /**
     * @var integer
     *
     * @ORM\Column(name="stake", type="integer", nullable=false)
     */
    private $stake;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status;

    /**
     * @var \Match
     *
     * @ORM\ManyToOne(targetEntity="Match")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match", referencedColumnName="id")
     * })
     */
    private $match;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_team", referencedColumnName="id")
     * })
     */
    private $team;


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
     * Set odds
     *
     * @param float $odds
     * @return Bet
     */
    public function setOdds($odds)
    {
        $this->odds = $odds;
    
        return $this;
    }

    /**
     * Get odds
     *
     * @return float 
     */
    public function getOdds()
    {
        return $this->odds;
    }

    /**
     * Set stake
     *
     * @param integer $stake
     * @return Bet
     */
    public function setStake($stake)
    {
        $this->stake = $stake;
    
        return $this;
    }

    /**
     * Get stake
     *
     * @return integer 
     */
    public function getStake()
    {
        return $this->stake;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Bet
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set idMatch
     *
     * @param \Match $match
     * @return Bet
     */
    public function setIdMatch($match = null)
    {
        $this->match = $match;
    
        return $this;
    }

    /**
     * Get match
     *
     * @return \Match 
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set User
     *
     * @param \User $user
     * @return Bet
     */
    public function setUser($user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get User
     *
     * @return \User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set Team
     *
     * @param \Team $team
     * @return Bet
     */
    public function setTeam($team = null)
    {
        $this->team = $team;
    
        return $this;
    }

    /**
     * Get Team
     *
     * @return \Team 
     */
    public function getTeam()
    {
        return $this->team;
    }
}
