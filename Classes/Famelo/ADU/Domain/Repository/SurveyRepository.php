<?php
namespace Famelo\ADU\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.ADU".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Surveys
 *
 * @Flow\Scope("singleton")
 */
class SurveyRepository extends \TYPO3\Flow\Persistence\Repository {

	public function getSurveyResultsByMonth() {
		$results = array();

			// Collect results
		foreach ($this->findAll() as $survey) {
			$month = $survey->getCreated()->format('n');
			if (!isset($results[$month])) {
				$results[$month] = array(
					'label' => $survey->getCreated()->format('m.Y'),
					'values' => array()
				);
			}
			$results[$month]['values'][] = $survey->getResult();
		}
		sort($results);

		foreach ($results as $month => $data) {
			$results[$month]['value'] = array_sum($data['values']) / count($data['values']);
		}

		return $results;
	}
}
?>