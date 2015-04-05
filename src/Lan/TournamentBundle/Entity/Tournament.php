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
     * @var \DateTime
     *
     * @ORM\Column(name="inscription", type="boolean")
     */
    private $inscription;

    /**
     * @ORM\OneToMany(targetEntity="Round", mappedBy="tournament")
     **/
    private $rounds;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\TournamentBundle\Entity\Team", inversedBy="tournaments")
     * @ORM\JoinTable(name="participants_tournaments")
     **/
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\ProfileBundle\Entity\User", inversedBy="tournMod")
     * @ORM\JoinTable(name="mods_tournaments")
     **/
    private $moderators;


    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->moderators = new ArrayCollection();
        $this->rounds = new ArrayCollection();
        $this->dateCreation = new \DateTime("now");
        $this->type = 0;
        $this->inscription = true;
    } 

    public function getTypeFormatted()
    {   
        $array = array(0 => "Joueur vs joueur", 1 => "par équipe", 2 => "mixte");
        return $array[$this->type];
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

    /**
     * Set type
     *
     * @param integer $type
     * @return Tournament
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add rounds
     *
     * @param \Lan\TournamentBundle\Entity\Round $rounds
     * @return Tournament
     */
    public function addRound(\Lan\TournamentBundle\Entity\Round $rounds)
    {
        $this->rounds[] = $rounds;

        return $this;
    }

    /**
     * Remove rounds
     *
     * @param \Lan\TournamentBundle\Entity\Round $rounds
     */
    public function removeRound(\Lan\TournamentBundle\Entity\Round $rounds)
    {
        $this->rounds->removeElement($rounds);
    }

    /**
     * Get rounds
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * Add participants
     *
     * @param \Lan\TournamentBundle\Entity\Team $participants
     * @return Tournament
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
     * Add moderators
     *
     * @param \Lan\ProfileBundle\Entity\User $moderators
     * @return Tournament
     */
    public function addModerator(\Lan\ProfileBundle\Entity\User $moderators)
    {
        $this->moderators[] = $moderators;

        return $this;
    }

    /**
     * Remove moderators
     *
     * @param \Lan\ProfileBundle\Entity\User $moderators
     */
    public function removeModerator(\Lan\ProfileBundle\Entity\User $moderators)
    {
        $this->moderators->removeElement($moderators);
    }

    /**
     * Get moderators
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModerators()
    {
        return $this->moderators;
    }

    /**
     * Set inscription
     *
     * @param boolean $inscription
     * @return Tournament
     */
    public function setInscription($inscription)
    {
        $this->inscription = $inscription;

        return $this;
    }

    /**
     * Get inscription
     *
     * @return boolean 
     */
    public function getInscription()
    {
        return $this->inscription;
    }
}
