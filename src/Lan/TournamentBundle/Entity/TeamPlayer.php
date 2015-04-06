<?php

namespace Lan\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TeamPlayer
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TeamPlayer
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="victories", type="integer")
     */
    private $victories;

    /**
     * @var string
     *
     * @ORM\Column(name="defeats", type="integer")
     */
    private $defeats;

    /**
     * @var integer
     *
     * @ORM\Column(name="draws", type="integer")
     */
    private $draws;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\TournamentBundle\Entity\Tournament", mappedBy="participants")
     **/
    private $tournaments;

    /**
     * @ORM\OneToMany(targetEntity="Lan\TournamentBundle\Entity\Team", mappedBy="parentTeam")
     **/
    private $shotTeams;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\ProfileBundle\Entity\User", inversedBy="teams")
     * @ORM\JoinTable(name="users_teamPlayer")
     **/
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Lan\TournamentBundle\Entity\Score", mappedBy="team")
     **/
    private $scores;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\ProfileBundle\Entity\User", inversedBy="teamMod")
     * @ORM\JoinTable(name="teamPlayer_userMod")
     **/
    private $moderators;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->moderators = new ArrayCollection();
        $this->tournaments = new ArrayCollection();
        $this->shotTeams = new ArrayCollection();
        $this->draws = 0;
        $this->defeats = 0;
        $this->victories = 0;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return TeamPlayer
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
     * Set victories
     *
     * @param integer $victories
     * @return TeamPlayer
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
     * @param integer $defeats
     * @return TeamPlayer
     */
    public function setDefeats($defeats)
    {
        $this->defeats = $defeats;

        return $this;
    }

    /**
     * Get defeats
     *
     * @return integer 
     */
    public function getDefeats()
    {
        return $this->defeats;
    }

    /**
     * Set draws
     *
     * @param integer $draws
     * @return TeamPlayer
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
     * Add tournaments
     *
     * @param \Lan\TournamentBundle\Entity\Tournament $tournaments
     * @return TeamPlayer
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
     * Add shotTeams
     *
     * @param \Lan\TournamentBundle\Entity\Team $shotTeams
     * @return TeamPlayer
     */
    public function addShotTeam(\Lan\TournamentBundle\Entity\Team $shotTeams)
    {
        $this->shotTeams[] = $shotTeams;

        return $this;
    }

    /**
     * Remove shotTeams
     *
     * @param \Lan\TournamentBundle\Entity\Team $shotTeams
     */
    public function removeShotTeam(\Lan\TournamentBundle\Entity\Team $shotTeams)
    {
        $this->shotTeams->removeElement($shotTeams);
    }

    /**
     * Get shotTeams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShotTeams()
    {
        return $this->shotTeams;
    }

    /**
     * Add users
     *
     * @param \Lan\ProfileBundle\Entity\User $users
     * @return TeamPlayer
     */
    public function addUser(\Lan\ProfileBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Lan\ProfileBundle\Entity\User $users
     */
    public function removeUser(\Lan\ProfileBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set personalUser
     *
     * @param \Lan\ProfileBundle\Entity\User $personalUser
     * @return TeamPlayer
     */
    public function setPersonalUser(\Lan\ProfileBundle\Entity\User $personalUser = null)
    {
        $this->personalUser = $personalUser;

        return $this;
    }

    /**
     * Get personalUser
     *
     * @return \Lan\ProfileBundle\Entity\User 
     */
    public function getPersonalUser()
    {
        return $this->personalUser;
    }

    /**
     * Add scores
     *
     * @param \Lan\TournamentBundle\Entity\Score $scores
     * @return TeamPlayer
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
     * Add moderators
     *
     * @param \Lan\ProfileBundle\Entity\User $moderators
     * @return TeamPlayer
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
}
