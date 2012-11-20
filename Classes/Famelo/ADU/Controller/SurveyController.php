<?php
namespace Famelo\ADU\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.ADU".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Survey controller for the Famelo.ADU package 
 *
 * @Flow\Scope("singleton")
 */
class SurveyController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * Index action
	 *
	 * @return void
	 */
	public function indexAction() {}

	/**
	 * New action
	 *
	 * @param \Famelo\ADU\Domain\Model\Customer $customer
	 * @return void
	 */
	public function newAction($customer) {
		$survey = new \Famelo\ADU\Domain\Model\Survey();
		$survey->setCustomer($customer);
		foreach ($customer->getBranch()->getMatchingQuestions() as $question) {
			$answer = new \Famelo\ADU\Domain\Model\Answer();
			$answer->setQuestion($question);
			$survey->addAnswer($answer);
		}
		$this->view->assign('survey', $survey);
	}

	/**
	 * create action
	 *
	 * @return void
	 */
	public function createAction() {
		$objects = $this->request->getInternalArgument('__objects');
		foreach ($objects as $object) {
			$this->persistenceManager->add($object);
		}
		$this->persistenceManager->persistAll();

		$this->redirect('index');
	}

	/**
	 * Index action
	 *
	 * @param \Famelo\ADU\Domain\Model\Survey $survey
	 * @return void
	 */
	public function completeAction($survey) {

	}
}

?>