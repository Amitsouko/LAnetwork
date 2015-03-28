<?php

namespace Lan\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Lan\TournamentBundle\Model\ParticipantInterface;

/**
 * Tournament
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lan\TournamentBundle\Entity\TournamentRepository")
 */
class Tournament
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type; // 0 -> individual, 1 -> team, 2 -> mixed

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateUpdate", type="datetime",nullable=true)
     */
    private $dateUpdate;


    /**
     * @ORM\OneToMany(targetEntity="Round", mappedBy="tournament")
     **/
    private $rounds;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\ProfileBundle\Entity\User", inversedBy="tournaments")
     * @ORM\JoinTable(name="participants_tournaments")
     **/
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\TournamentBundle\Entity\Team", inversedBy="tournaments")
     * @ORM\JoinTable(name="teamParticipants_tournaments")
     **/
    private $teamParticipants;


    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->teamParticipants = new ArrayCollection();
        $this->rounds = new ArrayCollection();
        $this->dateCreation = new \DateTime("now");
        $this->type = 0;
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
     * Set name
     *
     * @param string $name
     * @return Tournament
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Tournament
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Tournament
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
     * Set dateUpdate
     *
     * @param \DateTime $dateUpdate
     * @return Tournament
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * Get dateUpdate
     *
     * @return \DateTime 
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }
}
