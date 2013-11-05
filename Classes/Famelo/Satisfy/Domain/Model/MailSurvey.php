<?php
namespace Famelo\Satisfy\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Satisfy".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Survey
 *
 * @Flow\Entity
 */
class MailSurvey {
	use \Famelo\Vodoo\Traits\GettersSetters;

	/**
	 * @var \Famelo\Satisfy\Domain\Model\Contact
	 * @ORM\ManyToOne(inversedBy="surveys")
	 */
	protected $contact;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $sent;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $answered;

	/**
	 * @var \Doctrine\Common\Collections\Collection<\Famelo\Satisfy\Domain\Model\Result>
	 * @ORM\OneToMany(mappedBy="mailSurvey", cascade={"all"})
	 * @Flow\Lazy
	 */
	protected $results;

	/**
	 * @var \Famelo\Satisfy\Domain\Model\Campaign
	 * @ORM\ManyToOne(inversedBy="mailSurveys", cascade={"all"})
	 * @Flow\Lazy
	 */
	protected $campaign;

	public function __construct() {
		$this->results = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function __toString() {
		return 'Befragung des Kunden ' . $this->getContact();
	}
}
?>