<?php
namespace Application\Model\Entities;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="Users")
 **/
class User
{
    protected $bailouts;
    
    public function __construct() {
        $bailouts = new ArrayCollection();
    }
    
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    /**
     * @Column(type="string")
     **/
    protected $firstname;
    /**
     * @Column(type="string")
     **/
    protected $lastname;
    /**
     * @Column(type="string")
     **/
    protected $username; 
    /**
     * @Column(type="string")
     **/
    protected $address;
    /**
     * @Column(type="integer")
     **/
    protected $zip;
    /**
     * @Column(type="string")
     **/
    protected $city;
    /**
     * @Column(type="string")
     **/
    protected $email; 
    /**
     * @Column(type="integer")
     **/
    protected $moneybank; 
}