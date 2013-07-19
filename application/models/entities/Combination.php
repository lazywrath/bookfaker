<?php
namespace Application\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Combination
 *
 * @ORM\Table(name="bf_combination")
 * @ORM\Entity(repositoryClass="CombinationRepository")
 */
class Combination extends AEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     *@ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="combination", type="integer", nullable=false)
     */
    private $combination;

    /**
     * @var \Bet
     *
     * @ORM\OneToOne(targetEntity="bet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bet", referencedColumnName="id")
     * })
     */
    private $bet;

    /**
     * @var checkbet
     *
     * @ORM\Column(name="checkbet", type="integer", nullable=false)
     */
    private $checkbet;

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
     * Set Combination
     *
     * @param integer $combination
     * @return Combination
     */
    public function setCombination($combination)
    {
        $this->combination = $combination;
    
        return $this;
    }

    /**
     * Get Combination
     *
     * @return integer 
     */
    public function getCombination()
    {
        return $this->combination;
    }

    /**
     * Set Bet
     *
     * @param Bet $bet
     * @return Bet
     */
    public function setBet($bet)
    {
        $this->bet = $bet;
    
        return $this;
    }

    /**
     * Get Bet
     *
     * @return Bet 
     */
    public function getBet()
    {
        return $this->bet;
    }

    /**
     * Set Checkbet
     *
     * @param integer $checkbet
     * @return Checkbet
     */
    public function setCheckbet($checkbet)
    {
        $this->checkbet = $checkbet;
    
        return $this;
    }

    /**
     * Get Checkbet
     *
     * @return integer 
     */
    public function getCheckbet()
    {
        return $this->checkbet;
    }
}
