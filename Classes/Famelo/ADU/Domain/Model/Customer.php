<?php
namespace Famelo\ADU\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.ADU".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Customer
 *
 * @Flow\Entity
 */
class Customer {

	/**
	 * The name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * The name
	 *
	 * @var string
	 */
	protected $object;

	/**
	 * The cycle
	 *
	 * @var integer
	 */
	protected $cycle = 0;

	/**
	 * The contact
	 *
	 * @var \Famelo\ADU\Domain\Model\Contact
	 * @ORM\ManyToOne(inversedBy="customers", cascade={"persist"})
	 */
	protected $contact;

	/**
	 * The alternative contact
	 *
	 * @var \Famelo\ADU\Domain\Model\Contact
	 * @ORM\ManyToOne(inversedBy="alternative_customers", cascade={"persist"})
	 */
	protected $alternativeContact;

	/**
	 * The category
	 *
	 * @var \Famelo\ADU\Domain\Model\Category
	 * @ORM\ManyToOne(inversedBy="customers")
	 */
	protected $category;

	/**
	 * The consultant
	 *
	 * @var \Famelo\ADU\Domain\Model\User
	 * @ORM\ManyToOne(inversedBy="customers", cascade={"persist"})
	 */
	protected $consultant;

	/**
	 * The Branch
	 *
	 * @var \Famelo\ADU\Domain\Model\Branch
	 * @ORM\ManyToOne(inversedBy="customers", cascade={"persist"})
	 */
	protected $branch;

	/**
	 * The surveys
	 *
	 * @var \Doctrine\Common\Collections\Collection<\Famelo\ADU\Domain\Model\Survey>
	 * @ORM\OneToMany(mappedBy="customer", cascade={"persist"})
	 * @ORM\OrderBy({"created" = "DESC"})
	 */
	protected $surveys;

	/**
	 * The branch
	 * @var \Doctrine\Common\Collections\Collection<\Famelo\ADU\Domain\Model\Rating>
	 * @ORM\OneToMany(targetEntity="\Famelo\ADU\Domain\Model\Rating", mappedBy="customer")
	 * @ORM\OrderBy({"created" = "DESC"})
	 * @Flow\Lazy
	 */
	protected $ratings;

	/**
	 * The created
	 * @var \DateTime
	 */
	protected $created;

	/**
	 * The created
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $termination = NULL;

	/**
	 * The selfEvaluationResult
	 *
	 * @var float
	 */
	protected $selfEvaluationResult = 0;

	public function __construct() {
		$this->created = new \DateTime();
		$this->surveys = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function __toString() {
		return $this->getName();
	}

	public function getIdentity() {
		return $this->Persistence_Object_Identifier;
	}

	/**
	 * Get the Customer's name
	 *
	 * @return string The Customer's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Customer's name
	 *
	 * @param string $name The Customer's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get the Customer's cycle
	 *
	 * @return integer The Customer's cycle
	 */
	public function getCycle() {
		return $this->cycle;
	}

	/**
	 * Sets this Customer's cycle
	 *
	 * @param integer $cycle The Customer's cycle
	 * @return void
	 */
	public function setCycle($cycle) {
		$this->cycle = $cycle;
	}

	/**
	 * Get the Customer's contact
	 *
	 * @return \Famelo\ADU\Domain\Model\Contact The Customer's contact
	 */
	public function getContact() {
		return $this->contact;
	}

	/**
	 * Sets this Customer's contact
	 *
	 * @param \Famelo\ADU\Domain\Model\Contact $contact The Customer's contact
	 * @return void
	 */
	public function setContact($contact) {
		$this->contact = $contact;
	}

	/**
	 * Get the Customer's alternative contact
	 *
	 * @return \Famelo\ADU\Domain\Model\Contact The Customer's alternative contact
	 */
	public function getAlternativeContact() {
		return $this->alternativeContact;
	}

	/**
	 * Sets this Customer's alternative contact
	 *
	 * @param \Famelo\ADU\Domain\Model\Contact $alternativeContact The Customer's alternative contact
	 * @return void
	 */
	public function setAlternativeContact($alternativeContact) {
		$this->alternativeContact = $alternativeContact;
	}

	/**
	 * Get the Customer's category
	 *
	 * @return \Famelo\ADU\Domain\Model\Category The Customer's category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets this Customer's category
	 *
	 * @param \Famelo\ADU\Domain\Model\Category $category The Customer's category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * Get the Customer's consultant
	 *
	 * @return \Famelo\ADU\Domain\Model\Consultant The Customer's consultant
	 */
	public function getConsultant() {
		return $this->consultant;
	}

	/**
	 * Sets this Customer's consultant
	 *
	 * @param \Famelo\ADU\Domain\Model\User $consultant The Customer's consultant
	 * @return void
	 */
	public function setConsultant($consultant) {
		$this->consultant = $consultant;
	}

	/**
	 * Get the Customer's branch
	 *
	 * @return \Famelo\ADU\Domain\Model\Branch The Customer's branch
	 */
	public function getBranch() {
		if ($this->branch === NULL && $this->consultant !== NULL) {
			return $this->consultant->getBranch();
		}
		return $this->branch;
	}

	/**
	 * Sets this Customer's branch
	 *
	 * @param \Famelo\ADU\Domain\Model\Branch $branch The Customer's branch
	 * @return void
	 */
	public function setBranch($branch) {
		$this->branch = $branch;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection<\Famelo\ADU\Domain\Model\Survey> $surveys
	 */
	public function setSurveys($surveys) {
		$this->surveys = $surveys;
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection<\Famelo\ADU\Domain\Model\Survey>
	 */
	public function getSurveys() {
		return $this->surveys;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection<\Famelo\ADU\Domain\Model\Rating> $ratings
	 */
	public function setRatings($ratings) {
		$this->ratings = $ratings;
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection<\Famelo\ADU\Domain\Model\Rating>
	 */
	public function getRatings() {
		return $this->ratings;
	}

	/**
	 * @param \Famelo\ADU\Domain\Model\Rating $rating
	 */
	public function addRating($rating) {
		$this->ratings->add($rating);
	}

	/**
	 * @param string $object
	 */
	public function setObject($object) {
		$this->object = $object;
	}

	/**
	 * @return string
	 */
	public function getObject() {
		return $this->object;
	}

	/**
	 * @param float $selfEvaluationResult
	 */
	public function setSelfEvaluationResult($selfEvaluationResult) {
		$this->selfEvaluationResult = $selfEvaluationResult;
	}

	/**
	 * @return float
	 */
	public function getSelfEvaluationResult() {
		return $this->selfEvaluationResult;
	}

	public function getLatestSurvey() {
		return $this->surveys->first();
	}

	public function getLatestRating() {
		if ($this->ratings->count() > 0) {
			return $this->ratings->first();
		}
		return NULL;
	}

	public function getCurrentSurveyColor() {
		if ($this->getTermination() !== NULL) {
			return 'purple';
		}
		if ($this->isNew()) {
			return 'blue';
		}
		if (is_object($this->getLatestSurvey())) {
			return $this->getLatestSurvey()->getResultColor();
		}
		return 'white';
	}

	public function getCurrentRatingColor() {
		// if ($this->getTermination() !== NULL) {
		// 	return 'purple';
		// }
		// if ($this->isNew()) {
		// 	return 'blue';
		// }
		$colors = array(
			'1' => 'green',
			'2' => 'yellow',
			'3' => 'orange',
			'4' => 'red'
		);
		if (is_object($this->getLatestRating())) {
			return $colors[$this->getLatestRating()->getLevel()];
		}
		return 'white';
	}

	/**
	 * @param DateTime $created
	 */
	public function setCreated($created) {
		$this->created = $created;
	}

	/**
	 * @return DateTime
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * @param DateTime $termination
	 */
	public function setTermination($termination) {
		$this->termination = $termination;
	}

	/**
	 * @return DateTime
	 */
	public function getTermination() {
		if ($this->termination instanceof \DateTime && $this->termination->getTimestamp() > -62169987600) {
			return $this->termination;
		}
	}

	public function isNew() {
		$now = new \DateTime();
		return $this->getCreated()->diff($now)->format('%a') <= 30;
	}

	public function isSatisfied() {
		if ($this->getTermination() !== NULL) {
			return TRUE;
		}

		if ($this->isNew()) {
			return TRUE;
		}

		if (is_object($this->getLatestRating()) && $this->getLatestRating()->getLevel() > 1) {
			return FALSE;
		}

		if (is_object($this->getLatestSurvey()) && $this->getLatestSurvey()->getResult() < 5) {
			return FALSE;
		}

		return TRUE;
	}

	public function getMarker() {
		if ($this->getTermination() !== NULL) {
			return 'K';
		}
		if ($this->isNew()) {
			return 'N';
		}
		return FALSE;
	}
}
?>