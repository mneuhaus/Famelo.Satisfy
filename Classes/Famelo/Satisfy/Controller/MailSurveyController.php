<?php
namespace Famelo\Satisfy\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Satisfy".            *
 *                                                                        *
 *                                                                        */

use Famelo\Satisfy\Domain\Model\Result;
use TYPO3\Flow\Annotations as Flow;

/**
 * Overview controller for the Famelo.Satisfy package
 *
 * @Flow\Scope("singleton")
 */
class MailSurveyController extends \TYPO3\Flow\Mvc\Controller\ActionController {
	/**
	 * Index action
	 *
	 * @param \Famelo\Satisfy\Domain\Model\MailSurvey $survey
	 * @return void
	 */
	public function indexAction($survey) {
		if (count($survey->getResults()) === 0) {
			foreach ($survey->getCampaign()->getQuestions() as $question) {
				$result = new Result();
				$result->setQuestion($question->getBody());
				$result->setDate(new \DateTime());
				$result->setMailSurvey($survey);
				$survey->addResult($result);
			}
			$this->persistenceManager->update($survey);
			$this->persistenceManager->persistAll();
		}
		$this->view->assign('survey', $survey);
	}

	/**
	 * create action
	 *
	 * @return void
	 */
	public function createAction() {
		$surveys = $this->request->getInternalArgument('__objects');
		foreach ($surveys as $survey) {}

		$survey->setCreated(new \DateTime());

		foreach ($survey->getResults() as $result) {
			$result->setDate(new \DateTime());
			$result->setMailSurvey($survey);
		}

		$this->persistenceManager->update($survey);
		$this->persistenceManager->persistAll();
	}
}

?>