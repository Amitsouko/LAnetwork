<?php

namespace Lan\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Score
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
     * @ORM\Column(name="score", type="decimal")
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity="Lan\TournamentBundle\Entity\Team",inversedBy="scores")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     **/
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="Lan\TournamentBundle\Entity\Round")
     * @ORM\JoinColumn(name="round_id", referencedColumnName="id")
     **/
    private $round;

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
     * Set score
     *
     * @param string $score
     * @return Score
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set team
     *
     * @param \Lan\TournamentBundle\Entity\Team $team
     * @return Score
     */
    public function setTeam(\Lan\TournamentBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \Lan\TournamentBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set round
     *
     * @param \Lan\TournamentBundle\Entity\Round $round
     * @return Score
     */
    public function setRound(\Lan\TournamentBundle\Entity\Round $round = null)
    {
        $this->round = $round;

        return $this;
    }

    /**
     * Get round
     *
     * @return \Lan\TournamentBundle\Entity\Round 
     */
    public function getRound()
    {
        return $this->round;
    }
}
