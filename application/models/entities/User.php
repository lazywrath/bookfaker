<?php

namespace Application\Model\Entities;

/**
 * @Entity
 * @Table(name="user")
 */
class User
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $userId;
     
    /** @Column(type="string") */
    private $name;
     
    public function setName ($name)
    {
        $this->name = $name;
        return true;
    }
     
    public function getName()
    {
        return $this->name;
    }
}
?>
