<?php

namespace Application\Model\Entities;

/**
 * @Entity @Table(name="Sports")
 **/
class Sport
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