<?php
/**
 * @Entity @Table(name="Bailouts")
 * Table de recrédits
 **/
class Bailout
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    /**
     * @Column(type="datetime")
     **/
    protected $date;
    /**
     * @Column(type="integer")
     **/
    protected $amount;
    


}