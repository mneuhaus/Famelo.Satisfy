<?php
namespace Famelo\Satisfy\Domain\Wrapper;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Satisfy".            *
 *                                                                        *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use Famelo\Satisfy\Domain\Model\MailSurvey;
use TYPO3\Flow\Annotations as Flow;

/**
 * A Survey
 *
 */
class Survey {
	/**
	 * @var object
	 */
	protected $survey;

	public function __construct($survey) {
		$this->survey = $survey;
	}

	public function getScore() {
		if ($this->survey instanceof MailSurvey) {
			if (count($this->survey->getResults()) === 0) {
				return 'Noch nicht bewertet';
			}
		}

		return 'unknown survey';
	}
}
?>