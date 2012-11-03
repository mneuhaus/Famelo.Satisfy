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
	 * The cycle
	 *
	 * @var integer
	 */
	protected $cycle = 0;

	/**
	 * The contact
	 *
	 * @var \Famelo\ADU\Domain\Model\Contact
	 * @ORM\ManyToOne(inversedBy="customers", cascade={"all"})
	 */
	protected $contact;

	/**
	 * The alternative contact
	 *
	 * @var \Famelo\ADU\Domain\Model\Contact
	 * @ORM\ManyToOne(inversedBy="alternative_customers", cascade={"all"})
	 */
	protected $alternativeContact;

	/**
	 * The category
	 *
	 * @var \Famelo\ADU\Domain\Model\Category
	 * @ORM\ManyToOne(inversedBy="customers", cascade={"all"})
	 */
	protected $category;

	/**
	 * The consultant
	 *
	 * @var \Famelo\ADU\Domain\Model\User
	 * @ORM\ManyToOne(inversedBy="customers", cascade={"all"})
	 */
	protected $consultant;

	/**
	 * The Branch
	 *
	 * @var \Famelo\ADU\Domain\Model\Branch
	 * @ORM\ManyToOne(inversedBy="customers", cascade={"all"})
	 */
	protected $branch;


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
	 * @param \Famelo\ADU\Domain\Model\Consultant $consultant The Customer's consultant
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

}
?>