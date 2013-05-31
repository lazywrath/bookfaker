<?php
/**
 * @Entity @Table(name="Bookmakers")
 **/
class Bookmaker
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    /**
     * @Column(type="string")
     **/
    protected $name;
}