<?php

namespace Application\Model\Entities;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="bf_teams")
 **/
class Team
{
    public function __construct()
    {
        $this->championships = new ArrayCollection();
    }
    
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    
    /**
     * @Column(type="string")
     **/
    protected $name;
    
        
    /**
    * @ManyToMany(targetEntity="Championship",mappedBy="teams",cascade={"persist"})
    */
    protected $championships;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    public function getChampionships() {
        return $this->championships;
    }

    public function addChampionship($championship){
        $this->championships[]=$championship;
    }
}