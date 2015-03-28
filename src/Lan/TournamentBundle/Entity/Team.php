<?php

namespace Lan\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lan\TournamentBundle\Model\ParticipantInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Team
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Team implements ParticipantInterface
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
     * @ORM\ManyToMany(targetEntity="Lan\TournamentBundle\Entity\Tournament", mappedBy="teamParticipants")
     **/
    private $tournaments;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\TournamentBundle\Entity\Round", mappedBy="rounds")
     **/
    private $rounds;

    /**
     * @ORM\ManyToMany(targetEntity="Lan\ProfileBundle\Entity\User", inversedBy="teams")
     * @ORM\JoinTable(name="users_teams")
     **/
    private $users;

    /**
     * @ORM\OneToOne(targetEntity="Lan\ProfileBundle\Entity\User", mappedBy="personalTeam")
     **/
    private $personalUser;

    /**
     * @ORM\OneToMany(targetEntity="Lan\TournamentBundle\Entity\Score", mappedBy="team")
     **/
    private $scores;


    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->tournaments = new ArrayCollection();
        $this->rounds = new ArrayCollection();
        $this->draws = 0;
        $this->defeats = 0;
        $this->victories = 0;
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
     * @return Team
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
     * @return Team
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
     * @return Team
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
     * @return Team
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
     * @return Team
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
     * @return Team
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
     * @return Team
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
     * @return Team
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
     * Add rounds
     *
     * @param \Lan\TournamentBundle\Entity\Round $rounds
     * @return Team
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
     * Add users
     *
     * @param \Lan\ProfileBundle\Entity\User $users
     * @return Team
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
     * @return Team
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
     * @return Team
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
}
