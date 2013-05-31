<?php
/**
 * @Entity @Table(name="Games")
 **/
class Game
{
    protected $bets;
    
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    /**
     * @ManyToOne(targetEntity="Team", inversedBy="games")
     **/
    protected $idTeamOne;
    
    /**
     * @ManyToOne(targetEntity="Team", inversedBy="games")
     **/
    protected $idTeamTwo;
    /**
     * @Column(type="datetime")
     **/
    protected $date;
    /**
     * @ManyToOne(targetEntity="Championship", inversedBy="teams")
     **/
    protected $idChampionship;

    /**
     * @ManyToOne(targetEntity="Team", inversedBy="wonGames")
     **/
    protected $idWinner;


}