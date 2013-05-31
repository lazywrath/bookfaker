<?php
/**
 * @Entity @Table(name="Odds")
 * Table des cotes
 **/
class Odds
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    /**
     * @Column(type="datetime")
     **/
    protected $idGame;
    /**
     * @Column(type="integer")
     **/
    protected $oddsTeam1;
    /**
     * @Column(type="integer")
     **/
    protected $oddsTeam2;
    /**
     * @Column(type="integer")
     **/
    protected $idBookmaker;


}