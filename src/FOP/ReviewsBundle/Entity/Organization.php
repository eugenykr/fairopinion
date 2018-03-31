<?php

namespace FOP\ReviewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="FOP\ReviewsBundle\Entity\Repository\OrganizationRepository")
 * @ORM\Table(name="organization")
 * @ORM\HasLifecycleCallbacks
 */
class Organization
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
	protected $title;

	/**
	 * @ORM\Column(type="string", length=200)
	 */
	protected $short_description;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $description;

	/**
	 * @ORM\Column(type="text")
	 */
	protected $content;

	/**
	 * @ORM\Column(type="string", length=20)
	 */
	protected $image;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $address;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $phone;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $website;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $coords;

	/**
	 * @ORM\OneToMany(targetEntity="Review", mappedBy="organization")
	 */
	protected $reviews;

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
	    $this->reviews = new ArrayCollection();

    	$this->setCreated(new \DateTime());
	    $this->setUpdated(new \DateTime());
    }

	public function __toString()
	{
		return $this->getTitle();
	}
	/**
	 * @ORM\PreUpdate
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
     * Set title
     *
     * @param string $title
     *
     * @return Organization
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return Organization
     */
    public function setShortDescription($shortDescription)
    {
        $this->short_description = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Organization
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
     * Set content
     *
     * @param string $content
     *
     * @return Organization
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent($length = null)
    {
    	if (false === is_null($length) && $length > 0)
    		return substr($this->content, 0, $length);
    	else
    		return $this->content;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Organization
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Organization
     */
    public function setaddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getaddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Organization
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Organization
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set coords
     *
     * @param string $coords
     *
     * @return Organization
     */
    public function setCoords($coords)
    {
        $this->coords = $coords;

        return $this;
    }

    /**
     * Get coords
     *
     * @return string
     */
    public function getCoords()
    {
        return $this->coords;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Organization
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
     * @return Organization
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
     * Add review
     *
     * @param \FOP\ReviewsBundle\Entity\Review $review
     *
     * @return Organization
     */
    public function addReview(\FOP\ReviewsBundle\Entity\Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \FOP\ReviewsBundle\Entity\Review $review
     */
    public function removeReview(\FOP\ReviewsBundle\Entity\Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }
}
