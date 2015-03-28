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
     * @ORM\ManyToOne(targetEntity="Lan\ProfileBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Lan\TournamentBundle\Entity\Team")
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
}
