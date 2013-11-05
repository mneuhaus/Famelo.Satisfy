<?php
namespace Famelo\Satisfy\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Satisfy".        *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Category
 *
 * @Flow\Entity
 */
class Campaign {
	use \Famelo\Vodoo\Traits\GettersSetters;

	/**
	 * The name
	 * @var string
	 */
	protected $name;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $start;

	/**
	 * @var string
	 */
	protected $type = 'email';

	/**
	 * @var string
	 */
	protected $subject;

	/**
	 * @var string
	 */
	protected $body;

	/**
	 * @var string
	 */
	protected $intro;

	/**
	 * The questions
	 * @var \Doctrine\Common\Collections\Collection<\Famelo\Satisfy\Domain\Model\Question>
	 * @ORM\ManyToMany(cascade={"all"})
	 */
	protected $questions;

	/**
	 * The contact
	 *
	 * @var \Doctrine\Common\Collections\Collection<\Famelo\Satisfy\Domain\Model\Contact>
	 * @ORM\ManyToMany(cascade={"persist"})
	 * @Flow\Lazy
	 */
	protected $contacts;

	/**
	 * The contact
	 *
	 * @var \Doctrine\Common\Collections\Collection<\Famelo\Satisfy\Domain\Model\Customer>
	 * @ORM\ManyToMany(cascade={"persist"})
	 * @Flow\Lazy
	 */
	protected $customers;

	/**
	 * @var \Doctrine\Common\Collections\Collection<\Famelo\Satisfy\Domain\Model\MailSurvey>
	 * @ORM\OneToMany(mappedBy="campaign", cascade={"all"})
	 * @Flow\Lazy
	 */
	protected $mailSurveys;

	public function __toString() {
		return $this->getName();
	}
}
?>