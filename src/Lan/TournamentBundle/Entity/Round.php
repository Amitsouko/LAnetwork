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
     * @ORM\ManyToMany(targetEntity="Lan\TournamentBundle\Entity\Team", inversedBy="rounds")
     * @ORM\JoinTable(name="participants_rounds")
     **/
    private $participants;



    /**
     * @ORM\ManyToOne(targetEntity="Lan\TournamentBundle\Entity\Team",inversedBy="rounds")
     * @ORM\JoinColumn(name="winner_id", referencedColumnName="id")
     **/
    private $winner;




    public function __construct() {
        $this->participants = new ArrayCollection();
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

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Round
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateMatch
     *
     * @param \DateTime $dateMatch
     * @return Round
     */
    public function setDateMatch($dateMatch)
    {
        $this->dateMatch = $dateMatch;

        return $this;
    }

    /**
     * Get dateMatch
     *
     * @return \DateTime 
     */
    public function getDateMatch()
    {
        return $this->dateMatch;
    }

    /**
     * Add children
     *
     * @param \Lan\TournamentBundle\Entity\Round $children
     * @return Round
     */
    public function addChild(\Lan\TournamentBundle\Entity\Round $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Lan\TournamentBundle\Entity\Round $children
     */
    public function removeChild(\Lan\TournamentBundle\Entity\Round $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Lan\TournamentBundle\Entity\Round $parent
     * @return Round
     */
    public function setParent(\Lan\TournamentBundle\Entity\Round $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Lan\TournamentBundle\Entity\Round 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set tournament
     *
     * @param \Lan\TournamentBundle\Entity\Tournament $tournament
     * @return Round
     */
    public function setTournament(\Lan\TournamentBundle\Entity\Tournament $tournament = null)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \Lan\TournamentBundle\Entity\Tournament 
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Add participants
     *
     * @param \Lan\TournamentBundle\Entity\Team $participants
     * @return Round
     */
    public function addParticipant(\Lan\TournamentBundle\Entity\Team $participants)
    {
        $this->participants[] = $participants;

        return $this;
    }

    /**
     * Remove participants
     *
     * @param \Lan\TournamentBundle\Entity\Team $participants
     */
    public function removeParticipant(\Lan\TournamentBundle\Entity\Team $participants)
    {
        $this->participants->removeElement($participants);
    }

    /**
     * Get participants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Set winner
     *
     * @param \Lan\TournamentBundle\Entity\Team $winner
     * @return Round
     */
    public function setWinner(\Lan\TournamentBundle\Entity\Team $winner = null)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return \Lan\TournamentBundle\Entity\Team 
     */
    public function getWinner()
    {
        return $this->winner;
    }
}
