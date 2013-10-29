<?php
namespace Famelo\Satisfy\Services;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.Expose".               *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Manipulate the context variable "objects", which we expect to be a QueryResultInterface;
 * taking the "page" context variable into account (on which page we are currently).
 *
 * @Flow\Scope("singleton")
 */
class ReportService {
	/**
	 * The customerRepository
	 *
	 * @var \Famelo\Satisfy\Domain\Repository\CustomerRepository
	 * @Flow\Inject
	 */
	protected $customerRepository;

	/**
	 * @var \DateTime
	 */
	protected $datetime = NULL;

	public function __construct() {
		$this->datetime = new \DateTime();
	}

	public function setDateTime($datetime) {
		$this->datetime = $datetime;
	}

	public function getDateTime() {
		return $this->datetime;
	}

	public function getBranchPieCharts() {
		$customers = $this->customerRepository->findAll();
		$branches = array(
			'Gesamt' => array(
				'red' => 0,
				'orange' => 0,
				'yellow' => 0,
				'green' => 0
			)
		);
		foreach ($customers as $customer) {
			$survey = $customer->getLatestSurvey();
			if ($survey instanceof \Famelo\Satisfy\Domain\Model\Survey) {
				$branch = $customer->getBranch();
				if (!isset($branches[$branch->getName()])) {
					$branches[$branch->getName()] = array(
						'red' => 0,
						'orange' => 0,
						'yellow' => 0,
						'green' => 0
					);
				}
				$branches[$branch->getName()][$survey->getResultColor()]++;
				$branches['Gesamt'][$survey->getResultColor()]++;
			}
		}

		$charts = array();
		foreach ($branches as $branch => $data) {
			$piChart = new \gchart\gPieChart(200, 200);
			$piChart->setTitle($branch . ' (' . array_sum($data) . ')');
			$piChart->addDataSet(array_values($data));
			$precentages = array();
			if (array_sum($data) > 0) {
				foreach ($data as $key => $value) {
					$precentages[$key] = intval( ( $value / array_sum($data) ) * 100) . '%';
				}
				$piChart->setLegend($precentages);
				$piChart->setColors(array('df001a', 'f29400', 'ffed00', '009036'));
				$charts[] = str_replace('&amp;', '&', $piChart->getUrl());
			}
		}
		return $charts;
	}

	public function getScore($customer) {
		$week = $this->getDateTime()->format('W');

		$values = array();

		// Self Evaluation result
		$rating = $this->getRatingForWeek($customer, $week);
		if ($rating instanceof \Famelo\Satisfy\Domain\Model\Rating) {
			$level = $rating->getLevel();

			if ($customer->getIsTerminated()) {
				$level = 3.8;
			} elseif ($customer->getIsNew()) {
				$level = 3.9;
			}

			$values[] = $level;
		}

		// Survey result
		$survey = $this->getSurveyForWeek($customer, $week);
		if ($survey instanceof \Famelo\Satisfy\Domain\Model\Survey) {
			$values[] = $survey->getResult() * 4;
			if ($survey->getResult() > 0.5) {
				$values[] = $survey->getResult() * 4;
			}
		}

		if (count($values) > 0) {
			return ( array_sum($values) / count($values) ) * 10;
		}
		return 0.0001;
	}

	public function getRatingForWeek($customer, $week) {
		if (!$customer->getActive()) {
			$rating = new \Famelo\Satisfy\Domain\Model\Rating();
			$rating->setLevel(4);
			return $rating;
		}
		if ($customer->getRatings()->count() > 0) {
			foreach ($customer->getRatings() as $rating) {
				$ratingWeek = intval($rating->getCreated()->format('W'));
				if ($week == $ratingWeek) {
					return $rating;
				}
			}
		}
		return NULL;
	}

	public function getSurveyForWeek($customer, $week) {
		if ($customer->getSurveys()->count() > 0) {
			foreach ($customer->getSurveys() as $survey) {
				$surveyWeek = intval($survey->getCreated()->format('W'));
				if ($week == $surveyWeek) {
					return $survey;
				}
			}
		}
		return NULL;
	}
}
?>