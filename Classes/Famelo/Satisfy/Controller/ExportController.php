<?php
namespace Famelo\Satisfy\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package 'Famelo.Satisfy".            *
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

	/**
	 * @param \Famelo\Satisfy\Domain\Model\Campaign $campaign
	 * @return void
	 */
	public function campaignCsvAction($campaign) {
		$rows = array();
		foreach ($campaign->getMailSurveys() as $survey) {
			$row = array(
				'Firma' => $survey->getContact()->getCustomer()->__toString(),
				'Ansprechpartner' => $survey->getContact()->__toString(),
				'E-Mail' => $survey->getContact()->getEmail()
			);

			foreach ($survey->getResults() as $result) {
				$row[$result->getQuestion()] = $result->getData();
			}

			$rows[] = $row;
		}

		$output = fopen('php://output', 'w');
		header('Cache-Control: private', false);
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $campaign->getName() . '.csv";');
		header('Content-Transfer-Encoding: binary');
		fputcsv($output, array_keys(reset($rows)), ';');
		foreach ($rows as $row) {
			fputcsv($output, $row, ';');
		}
		fclose($output);

		exit();
	}
}

?>