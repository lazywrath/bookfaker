<?php

namespace Application\Model\Entities;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="bf_championships")
 **/
class Championship
{   
    public function __construct()
    {
        $this->teams = new ArrayCollection();
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
    * @ManyToMany(targetEntity="Team", inversedBy="championships",cascade={"persist"})
    * @JoinTable(name="bf_championships_teams",
    *      joinColumns={@JoinColumn(name="id_championship", referencedColumnName="id")},
    *      inverseJoinColumns={@JoinColumn(name="id_team", referencedColumnName="id")}
    * )
    */
    protected $teams;
    
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
    
    public function getTeams() {
        return $this->teams;
    }
    
    public function addTeam($team){
        $this->teams[] = $team;
    }
}