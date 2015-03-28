<?php

namespace Lan\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Privacy
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lan\CoreBundle\Entity\PrivacyRepository")
 */
class Privacy
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
     * @var string
     *
     * @ORM\Column(name="strengh", type="integer", nullable=true)
     */
    private $strengh;


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
     * @return Privacy
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
     * Set strengh
     *
     * @param string $strengh
     * @return Privacy
     */
    public function setStrengh($strengh)
    {
        $this->strengh = $strengh;

        return $this;
    }

    /**
     * Get strengh
     *
     * @return string 
     */
    public function getStrengh()
    {
        return $this->strengh;
    }
}
