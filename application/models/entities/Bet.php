<?php
/**
 * @Entity @Table(name="Bets")
 **/
class Bet
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    /**
     * @ManyToOne(targetEntity="Game", inversedBy="bets")
     **/
    protected $idGame;
    /**
     * @ManyToOne(targetEntity="User", inversedBy="bets")
     **/
    protected $idUser;
    /**
     * @Column(type="integer")
     **/
    protected $odds; // cote
    /**
     * @Column(type="integer")
     **/
    protected $stake; // mise
    /**
     * @Column(type="integer")
     **/
    protected $state; // etat du pari


}