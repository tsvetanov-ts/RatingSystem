<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Validator\Constraints as Assert;
use UserBundle\Entity\User;

/**
 * Reviews
 *
 * @ORM\Table(name="reviews",
 *     uniqueConstraints={
 *          @UniqueConstraint(name="unique_review",
 *              columns={"product_id","user_id"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\ReviewsRepository")
 */
class Reviews
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer")
     *
     * @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      minMessage = "Rating must be at least 1",
     *      maxMessage = "Rating must be lower than or equal to 5"
     * )
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProductBundle\Entity\Product"
     *
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="UserBundle\Entity\User",
     *
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;
    /**
     * @var int
     * @ORM\Column(name="product_id", type="integer")
     */
    private $product_id;

    /**
     * @var int
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     * @return Reviews
     */
    public function setProductId(int $product_id): Reviews
    {
        $this->product_id = $product_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return Reviews
     */
    public function setUserId(int $user_id): Reviews
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @var boolean
     * @ORM\Column(name="is_approved", type="boolean")
     */

    private $isApproved;

    public function __construct()
    {
        $this->attendees = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Reviews
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Reviews
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
     * Set product
     *
     * @param Product $product
     *
     * @return Reviews
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Reviews
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return bool
     */
    public function isApproved()
    {
        return $this->isApproved;
    }

    /**
     * @param bool $isApproved
     * @return Reviews
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;
        return $this;
    }




}

