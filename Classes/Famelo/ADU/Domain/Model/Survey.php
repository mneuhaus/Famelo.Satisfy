<?php
namespace Famelo\ADU\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.ADU".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Survey
 *
 * @Flow\Entity
 */
class Survey {

	/**
	 * The customer
	 * @var \Famelo\ADU\Domain\Model\Customer
	 * @ORM\ManyToOne(cascade={"persist"})
	 */
	protected $customer;

	/**
	 * The created
	 * @var \DateTime
	 */
	protected $created;

	/**
	 * The rating
	 * @var \Famelo\ADU\Domain\Model\Rating
	 * @ORM\OneToOne(cascade={"persist"})
	 */
	protected $rating;

	/**
	 * The answers
	 * @var \Doctrine\Common\Collections\Collection<\Famelo\ADU\Domain\Model\Answer>
	 * @ORM\OneToMany(mappedBy="survey", cascade={"persist"})
	 */
	protected $answers;

	public function __construct() {
		$this->created = new \DateTime();
		$this->answers = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Get the Survey's customer
	 *
	 * @return \Famelo\ADU\Domain\Model\Customer The Survey's customer
	 */
	public function getCustomer() {
		return $this->customer;
	}

	/**
	 * Sets this Survey's customer
	 *
	 * @param \Famelo\ADU\Domain\Model\Customer $customer The Survey's customer
	 * @return void
	 */
	public function setCustomer($customer) {
		$this->customer = $customer;
	}

	/**
	 * Get the Survey's created
	 *
	 * @return \DateTime The Survey's created
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * Sets this Survey's created
	 *
	 * @param \DateTime $created The Survey's created
	 * @return void
	 */
	public function setCreated($created) {
		$this->created = $created;
	}

	/**
	 * Get the Survey's rating
	 *
	 * @return \Famelo\ADU\Domain\Model\Rating The Survey's rating
	 */
	public function getRating() {
		return $this->rating;
	}

	/**
	 * Sets this Survey's rating
	 *
	 * @param \Famelo\ADU\Domain\Model\Rating $rating The Survey's rating
	 * @return void
	 */
	public function setRating($rating) {
		$this->rating = $rating;
	}

	/**
	 * Get the Survey's answers
	 *
	 * @return \Doctrine\Common\Collections\Collection<\Famelo\ADU\Domain\Model\Answer>
	 */
	public function getAnswers() {
		return $this->answers;
	}

	/**
	 * Sets this Survey's answers
	 *
	 * @param \Doctrine\Common\Collections\Collection<\Famelo\ADU\Domain\Model\Answer> $answers The Survey's answers
	 * @return void
	 */
	public function setAnswers($answers) {
		foreach ($answers as $answer) {
			$answer->setSurvey($this);
		}
		$this->answers = $answers;
	}

	/**
	 * Sets this Survey's answers
	 *
	 * @param \Famelo\ADU\Domain\Model\Answer $answer The Survey's answer
	 * @return void
	 */
	public function addAnswer($answer) {
		$answer->setSurvey($this);
		$this->answers->add($answer);
	}

	public function getResult() {
		$result = 0;
		foreach ($this->getAnswers() as $answer) {
			$result += ($answer->getAnswer() * $answer->getQuestion()->getWeight());
		}
		return $result;
	}

	public function getResultColor() {
		$colors = array(
			0 => 'red',
			1 => 'orange',
			3 => 'yellow',
			5 => 'green'
		);
		$result = $this->getResult();
		$lastValue = 0;
		foreach ($colors as $value => $color) {
				// var_dump($result . '>=' . $lastValue .'&&'. $result .'<='. $value);
			if ($result >= $lastValue && $result <= $value) {
				return $matchingColor;
			}
			$lastValue = $value;
			$matchingColor = $color;
		}
	}
}
?>