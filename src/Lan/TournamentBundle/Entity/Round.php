<?php

namespace Lan\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Round
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lan\TournamentBundle\Entity\RoundRepository")
 */
class Round
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="degree", type="integer")
     */
    private $degree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateMatch", type="datetime",nullable=true)
     */
    private $dateMatch;

    /**
     * @ORM\OneToMany(targetEntity="Round", mappedBy="parent")
     **/
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Round", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    private $parent;


    /**
     * @ORM\ManyToOne(targetEntity="Tournament", inversedBy="rounds")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     **/
    private $tournament;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\ProfileBundle\Entity\User", inversedBy="rounds")
     * @ORM\JoinTable(name="participants_rounds")
     **/
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\TournamentBundle\Entity\Team", inversedBy="rounds")
     * @ORM\JoinTable(name="teamParticipants_rounds")
     **/
    private $teamParticipants;

    /**
     * @ORM\ManyToOne(targetEntity="Lan\ProfileBundle\Entity\User")
     * @ORM\JoinColumn(name="winner_id", referencedColumnName="id")
     **/
    private $winner;

    /**
     * @ORM\ManyToOne(targetEntity="Lan\TournamentBundle\Entity\Team")
     * @ORM\JoinColumn(name="teamWinner_id", referencedColumnName="id")
     **/
    private $teamWinner;



    public function __construct() {
        $this->participants = new ArrayCollection();
        $this->teamParticipants = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->dateCreation = new \DateTime("now");
    }


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
     * Set degree
     *
     * @param integer $degree
     * @return Round
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * Get degree
     *
     * @return integer 
     */
    public function getDegree()
    {
        return $this->degree;
    }
}
