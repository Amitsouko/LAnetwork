<?php

namespace Lan\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Lan\TournamentBundle\Model\ParticipantInterface;
use \Doctrine\Common\Collections\ArrayCollection;
/**
 * User
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Lan\ProfileBundle\Entity\UserRepository")
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255,nullable=true)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var integer
     *
     * @ORM\Column(name="victories", type="integer")
     */
    private $victories;

    /**
     * @var string
     *
     * @ORM\Column(name="defeats", type="string", length=255)
     */
    private $defeats;

    /**
     * @var integer
     *
     * @ORM\Column(name="draws", type="integer")
     */
    private $draws;

    /**
     * @var integer
     *
     * @ORM\Column(name="teamVictories", type="integer")
     */
    private $teamVictories;

    /**
     * @var integer
     *
     * @ORM\Column(name="teamDefeats", type="integer")
     */
    private $teamDefeats;

    /**
     * @var integer
     *
     * @ORM\Column(name="teamDraws", type="integer")
     */
    private $teamDraws;


    /**
     * @ORM\ManyToMany(targetEntity="Lan\TournamentBundle\Entity\Tournament", mappedBy="participants")
     **/
    private $tournaments;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\TournamentBundle\Entity\Team", mappedBy="users")
     **/
    private $teams;

    /**
     * @ORM\OneToOne(targetEntity="Lan\TournamentBundle\Entity\Team", inversedBy="personalUser")
     * @ORM\JoinColumn(name="personnal_team_id", referencedColumnName="id")
     **/
    private $personalTeam;





    public function __construct()
    {
        parent::__construct();
        $this->draws = 0;
        $this->defeats = 0;
        $this->victories = 0;
        $this->teamDraws = 0;
        $this->teamDefeats = 0;
        $this->teamVictories = 0;
        $this->tournaments = new ArrayCollection();
        $this->rounds = new ArrayCollection();
        $this->scores = new ArrayCollection();
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
     * Set picture
     *
     * @param string $picture
     * @return User
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set victories
     *
     * @param integer $victories
     * @return User
     */
    public function setVictories($victories)
    {
        $this->victories = $victories;

        return $this;
    }

    /**
     * Get victories
     *
     * @return integer 
     */
    public function getVictories()
    {
        return $this->victories;
    }

    /**
     * Set defeats
     *
     * @param string $defeats
     * @return User
     */
    public function setDefeats($defeats)
    {
        $this->defeats = $defeats;

        return $this;
    }

    /**
     * Get defeats
     *
     * @return string 
     */
    public function getDefeats()
    {
        return $this->defeats;
    }

    /**
     * Set draws
     *
     * @param integer $draws
     * @return User
     */
    public function setDraws($draws)
    {
        $this->draws = $draws;

        return $this;
    }

    /**
     * Get draws
     *
     * @return integer 
     */
    public function getDraws()
    {
        return $this->draws;
    }

    /**
     * Set teamVictories
     *
     * @param integer $teamVictories
     * @return User
     */
    public function setTeamVictories($teamVictories)
    {
        $this->teamVictories = $teamVictories;

        return $this;
    }

    /**
     * Get teamVictories
     *
     * @return integer 
     */
    public function getTeamVictories()
    {
        return $this->teamVictories;
    }

    /**
     * Set teamDefeats
     *
     * @param integer $teamDefeats
     * @return User
     */
    public function setTeamDefeats($teamDefeats)
    {
        $this->teamDefeats = $teamDefeats;

        return $this;
    }

    /**
     * Get teamDefeats
     *
     * @return integer 
     */
    public function getTeamDefeats()
    {
        return $this->teamDefeats;
    }

    /**
     * Set teamDraws
     *
     * @param integer $teamDraws
     * @return User
     */
    public function setTeamDraws($teamDraws)
    {
        $this->teamDraws = $teamDraws;

        return $this;
    }

    /**
     * Get teamDraws
     *
     * @return integer 
     */
    public function getTeamDraws()
    {
        return $this->teamDraws;
    }

    /**
     * Add tournaments
     *
     * @param \Lan\TournamentBundle\Entity\Tournament $tournaments
     * @return User
     */
    public function addTournament(\Lan\TournamentBundle\Entity\Tournament $tournaments)
    {
        $this->tournaments[] = $tournaments;

        return $this;
    }

    /**
     * Remove tournaments
     *
     * @param \Lan\TournamentBundle\Entity\Tournament $tournaments
     */
    public function removeTournament(\Lan\TournamentBundle\Entity\Tournament $tournaments)
    {
        $this->tournaments->removeElement($tournaments);
    }

    /**
     * Get tournaments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTournaments()
    {
        return $this->tournaments;
    }

    /**
     * Add teams
     *
     * @param \Lan\TournamentBundle\Entity\Team $teams
     * @return User
     */
    public function addTeam(\Lan\TournamentBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;

        return $this;
    }

    /**
     * Remove teams
     *
     * @param \Lan\TournamentBundle\Entity\Team $teams
     */
    public function removeTeam(\Lan\TournamentBundle\Entity\Team $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Set personnalTeam
     *
     * @param \Lan\TournamentBundle\Entity\Team $personnalTeam
     * @return User
     */
    public function setPersonnalTeam(\Lan\TournamentBundle\Entity\Team $personnalTeam = null)
    {
        $this->personnalTeam = $personnalTeam;

        return $this;
    }

    /**
     * Get personnalTeam
     *
     * @return \Lan\TournamentBundle\Entity\Team 
     */
    public function getPersonnalTeam()
    {
        return $this->personnalTeam;
    }

    /**
     * Add rounds
     *
     * @param \Lan\TournamentBundle\Entity\Round $rounds
     * @return User
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
     * Add scores
     *
     * @param \Lan\TournamentBundle\Entity\Score $scores
     * @return User
     */
    public function addScore(\Lan\TournamentBundle\Entity\Score $scores)
    {
        $this->scores[] = $scores;

        return $this;
    }

    /**
     * Remove scores
     *
     * @param \Lan\TournamentBundle\Entity\Score $scores
     */
    public function removeScore(\Lan\TournamentBundle\Entity\Score $scores)
    {
        $this->scores->removeElement($scores);
    }

    /**
     * Get scores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * Set personalTeam
     *
     * @param \Lan\TournamentBundle\Entity\Team $personalTeam
     * @return User
     */
    public function setPersonalTeam(\Lan\TournamentBundle\Entity\Team $personalTeam = null)
    {
        $this->personalTeam = $personalTeam;

        return $this;
    }

    /**
     * Get personalTeam
     *
     * @return \Lan\TournamentBundle\Entity\Team 
     */
    public function getPersonalTeam()
    {
        return $this->personalTeam;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return User
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
}
