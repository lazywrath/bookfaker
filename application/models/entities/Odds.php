<?php
namespace Application\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Odds
 *
 * @ORM\Table(name="bf_odds")
 * @ORM\Entity
 */
class Odds
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
     * @ORM\Column(name="odds_team_one", type="float", nullable=true)
     */
    private $oddsTeamOne;

    /**
     * @var float
     *
     * @ORM\Column(name="odds_team_two", type="float", nullable=true)
     */
    private $oddsTeamTwo;

    /**
     * @var float
     *
     * @ORM\Column(name="odds_draw", type="float", nullable=true)
     */
    private $oddsDraw;

    /**
     * @var \Bookmaker
     *
     * @ORM\ManyToOne(targetEntity="Bookmaker")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_bookmaker", referencedColumnName="id")
     * })
     */
    private $bookmaker;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set oddsTeamOne
     *
     * @param float $oddsTeamOne
     * @return Odds
     */
    public function setOddsTeamOne($oddsTeamOne)
    {
        $this->oddsTeamOne = $oddsTeamOne;
    
        return $this;
    }

    /**
     * Get oddsTeamOne
     *
     * @return float 
     */
    public function getOddsTeamOne()
    {
        return $this->oddsTeamOne;
    }

    /**
     * Set oddsTeamTwo
     *
     * @param float $oddsTeamTwo
     * @return Odds
     */
    public function setOddsTeamTwo($oddsTeamTwo)
    {
        $this->oddsTeamTwo = $oddsTeamTwo;
    
        return $this;
    }

    /**
     * Get oddsTeamTwo
     *
     * @return float 
     */
    public function getOddsTeamTwo()
    {
        return $this->oddsTeamTwo;
    }

    /**
     * Set oddsDraw
     *
     * @param float $oddsDraw
     * @return Odds
     */
    public function setOddsDraw($oddsDraw)
    {
        $this->oddsDraw = $oddsDraw;
    
        return $this;
    }

    /**
     * Get oddsDraw
     *
     * @return float 
     */
    public function getOddsDraw()
    {
        return $this->oddsDraw;
    }

    /**
     * Set bookamer
     *
     * @param \Bookmaker $bookmaker
     * @return Odds
     */
    public function setIdBookmaker($bookmaker = null)
    {
        $this->bookmaker = $bookmaker;
    
        return $this;
    }

    /**
     * Get bookmaker
     *
     * @return \Bookmaker 
     */
    public function getBookmaker()
    {
        return $this->bookmaker;
    }

    /**
     * Set idMatch
     *
     * @param \Match match
     * @return Odds
     */
    public function setMatch( $match = null)
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
}
