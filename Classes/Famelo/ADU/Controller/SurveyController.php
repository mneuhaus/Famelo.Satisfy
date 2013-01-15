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
	 * The securityContext
	 *
	 * @var \TYPO3\Flow\Security\Context
	 * @Flow\Inject
	 */
	protected $securityContext;

	/**
	 * The customerRepository
	 *
	 * @var \Famelo\ADU\Domain\Repository\CustomerRepository
	 * @Flow\Inject
	 */
	protected $customerRepository;

	/**
	 * Index action
	 *
	 * @return void
	 */
	public function indexAction() {}

	/**
	 * Index action
	 *
	 * @return void
	 */
	public function happinessAction() {
		$query = $this->customerRepository->createQuery();
		if ($this->securityContext->hasRole('Administrator')) {
			$query->matching($query->equals('consultant', $this->securityContext->getParty()));
		}
		$this->view->assign('customers', $query->execute());
	}

	/**
	 * Index action
	 *
	 * @param array $ratings
	 * @return void
	 */
	public function saveHappinessAction($ratings) {
		foreach ($ratings as $identifier => $data) {
			$customer = $this->customerRepository->findByIdentifier($identifier);
			$rating = new \Famelo\ADU\Domain\Model\Rating();
			if (!isset($data['value'])) {
				continue;
			}
			$rating->setLevel($data['value']);
			if (isset($data['comment'])) {
				$rating->setComment($data['comment']);
			}
			if (isset($data['action'])) {
				$rating->setAction($data['action']);
			}
			if (isset($data['date'])) {
				$rating->setDate(new \DateTime($data['date']));
			}
			$rating->setCustomer($customer);
			$this->persistenceManager->add($rating);

			$customer->setSelfEvaluationResult($data['value']);
			$this->persistenceManager->update($customer);
		}
	}

	/**
	 * @return void
	 */
	public function ratingsAction() {
	}

	/**
	 * New action
	 *
	 * @return void
	 */
	public function newAction() {
		$survey = new \Famelo\ADU\Domain\Model\Survey();
		foreach ($this->securityContext->getParty()->getBranch()->getMatchingQuestions() as $question) {
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
	}

	/**
	 * Index action
	 *
	 * @param \Famelo\ADU\Domain\Model\Survey $survey
	 * @return void
	 */
	public function completeAction($survey) {}
}

?>