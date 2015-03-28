<?php

namespace Lan\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Lan\TournamentBundle\Model\ParticipantInterface;
/**
 * User
 *
 * @ORM\Table()
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
     * @ORM\ManyToMany(targetEntity="Lan\TournamentBundle\Entity\Round", mappedBy="rounds")
     **/
    private $rounds;

    /**
     * @ORM\OneToMany(targetEntity="Lan\TournamentBundle\Entity\Score", mappedBy="user")
     **/
    private $scores;

    public function __construct()
    {
        parent::__construct();
        $this->draws = 0;
        $this->defeats = 0;
        $this->victories = 0;
        $this->teamDraws = 0;
        $this->teamDefeats = 0;
        $this->teamVictories = 0;
        $this->tournaments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rounds = new \Doctrine\Common\Collections\ArrayCollection();
        $this->scores = new \Doctrine\Common\Collections\ArrayCollection();
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
}
