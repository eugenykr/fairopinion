<?php

namespace FOP\ReviewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
/**
 * @ORM\Entity(repositoryClass="FOP\ReviewsBundle\Entity\Repository\ReviewRepository")
 * @ORM\Table(name="review")
 * @ORM\HasLifecycleCallbacks
 */
class Review
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $user;

	/**
	 * @ORM\Column(type="text")
	 */
	protected $comment;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $approved;

	/**
	 * @ORM\Column(type="smallint")
	 */
	protected $rate;

	/**
	 * @ORM\ManyToOne(targetEntity="Organization", inversedBy="reviews")
	 * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
	 */
	protected $organization;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $created;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $updated;

	public function __construct()
	{
		$this->setCreated(new \DateTime());
		$this->setUpdated(new \DateTime());

		$this->setApproved(true);
	}

	public function __toString()
	{
		return $this->getUser();
	}

	/**
	 * Vaidations
	 */
	public static function loadValidatorMetadata(ClassMetadata $metadata)
	{
		$metadata->addPropertyConstraint('user', new NotBlank(array(
			'message' => 'Введите имя'
		)));
		$metadata->addPropertyConstraint('comment', new NotBlank(array(
			'message' => 'Введите комментарий'
		)));
	}

	/**
	 * @ORM\preUpdate
	 */
	public function setUpdatedValue()
	{
		$this->setUpdated(new \DateTime());
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
     * Set user
     *
     * @param string $user
     *
     * @return Review
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Review
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     *
     * @return Review
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     *
     * @return Review
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Review
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Review
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set organization
     *
     * @param \FOP\ReviewsBundle\Entity\Organization $organization
     *
     * @return Review
     */
    public function setOrganization(\FOP\ReviewsBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return \FOP\ReviewsBundle\Entity\Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }
}
