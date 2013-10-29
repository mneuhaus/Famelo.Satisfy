<?php
namespace Famelo\Satisfy\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Satisfy".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Survey controller for the Famelo.Satisfy package
 *
 * @Flow\Scope("singleton")
 */
class ExportController extends \TYPO3\Flow\Mvc\Controller\ActionController {
	/**
	 * @param \Famelo\Satisfy\Domain\Model\Survey $survey
	 * @return void
	 */
	public function surveyAction($survey) {
		$document = new \Famelo\PDF\Document('Famelo.Satisfy:SurveySummary');
		$document->assign('survey', $survey);
		// TODO: String to -> Settings!
		$document->download('Satisfy Bewertung ' . $survey->getCreated()->format('d.m.Y') . '.pdf');
	}
}

?>