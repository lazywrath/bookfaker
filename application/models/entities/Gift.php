<?php
namespace Application\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gift
 *
 * @ORM\Table(name="bf_gift")
 * @ORM\Entity(repositoryClass="GiftRepository")
 */
class Gift extends AEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Name
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     *
     */
    private $name;

    /**
     * @var \Bookies
     *
     * @ORM\Column(name="bookies", type="integer", nullable=false)
     *
     */
    private $bookies;

    /**
     * @var \Image
     *
     * @ORM\Column(name="image", type="string", nullable=false)
     *
     */
    private $image;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Name
     *
     * @param \Name name
     * @return Name
     */
    public function setName( $name = null)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return \Name 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Bookies
     *
     * @param \Bookies bookies
     * @return Bookies
     */
    public function setBookies( $bookies = null)
    {
        $this->bookies = $bookies;
    
        return $this;
    }

    /**
     * Get bookies
     *
     * @return \Bookies 
     */
    public function getBookies()
    {
        return $this->bookies;
    }

    /**
     * Set image
     *
     * @param \Image $image
     * @return Image
     */
    public function setImage($image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get Image
     *
     * @return \Image 
     */
    public function getImage()
    {
        return $this->image;
    }
    
    
}
