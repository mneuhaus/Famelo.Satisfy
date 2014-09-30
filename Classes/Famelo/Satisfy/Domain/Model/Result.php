<?php
namespace Famelo\Satisfy\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Satisfy".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Survey Result
 *
 * @Flow\Entity
 */
class Result {
	use \Famelo\Vodoo\Traits\GettersSetters;

	/**
	 * The customer
	 * @var \Famelo\Satisfy\Domain\Model\MailSurvey
	 * @ORM\ManyToOne(inversedBy="results", cascade={"all"})
     * @ORM\JoinColumn(onDelete="CASCADE")
	 * @Flow\Lazy
	 */
	protected $mailSurvey;

	/**
	 * The action
	 * @var string
	 */
	protected $question = '';

	/**
	 * The date
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * The data
	 * @var string
	 */
	protected $data = '';

	public function __construct() {
		$this->date = new \DateTime();
	}
}

?>