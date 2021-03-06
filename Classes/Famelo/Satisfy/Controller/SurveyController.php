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
	 * @var \Famelo\Satisfy\Domain\Repository\CustomerRepository
	 * @Flow\Inject
	 */
	protected $customerRepository;

	/**
	 * The branchRepository
	 *
	 * @var \Famelo\Satisfy\Domain\Repository\BranchRepository
	 * @Flow\Inject
	 */
	protected $branchRepository;

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
		$query = $this->customerRepository->createQuery(FALSE);

		$threshold = new \DateTime('-30d');
		$query->matching($query->logicalAnd(
			$query->equals('consultant', $this->securityContext->getParty()),
			$query->logicalOr(
				$query->greaterThan('termination', $threshold),
				$query->equals('termination', NULL)
			)
		));

		$this->view->assign('customers', $query->execute());

		foreach ($query->execute() as $customer) {
			// var_dump($customer->__toString());
		}

		$this->view->assign('week', intval(date('W')));
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
			if ($customer->getRatingForThisWeek() !== NULL) {
				$rating = $customer->getRatingForThisWeek();
			} else {
				$rating = new \Famelo\Satisfy\Domain\Model\Rating();
			}
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

			if ($customer->getRatingForThisWeek() !== NULL) {
				$this->persistenceManager->update($rating);
			} else {
				$this->persistenceManager->add($rating);
			}

			$customer->setSelfEvaluationResult($data['value']);
			$customer->calculateSelfEvaluationResult();
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
		$survey = new \Famelo\Satisfy\Domain\Model\Survey();
		$branch = $this->securityContext->getParty()->getBranch();
		if (!$branch instanceof \Famelo\Satisfy\Domain\Model\Branch) {
			$branch = $this->branchRepository->findOneByName('Satisfy');
		}
		foreach ($branch->getMatchingQuestions() as $question) {
			$answer = new \Famelo\Satisfy\Domain\Model\Answer();
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
		$surveys = $this->request->getInternalArgument('__objects');
		foreach ($surveys as $survey) {
			$this->persistenceManager->add($survey);
		}

		if ($survey->getMoreSecurity() || $survey->getMoreService()) {
			$mail = new \Famelo\Messaging\Message();

			// TODO: from -> Settings!
			$mail
				->setFrom(array('no-reply@adu-kundenzufriedenheit.de' => 'Satisfy Kundenzufriedenheit'))
				->setSubject('Anfrage nach mehr Informationen')
				->setMessage('Famelo.Satisfy:MoreInformation')
				->assign('survey', $survey);

			$recipients = $this->configurationManager->getConfiguration(\TYPO3\Flow\Configuration\ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Famelo.Kundenbefragung.E-Mails.MoreInformation');
			$mail->setTo($recipients);
			$mail->send();
		}

		$mail = new \Famelo\Messaging\Message();

		// TODO: from -> Settings!
		$mail
			->setFrom(array('no-reply@adu-kundenzufriedenheit.de' => 'Satisfy Kundenzufriedenheit'))
			->setSubject('Vielen Dank für Ihre Bewertung')
			->setMessage('Famelo.Satisfy:NotifyCustomerAboutSurvey')
			->assign('survey', $survey);

		if ($survey->getContact() instanceof \Famelo\Satisfy\Domain\Model\Contact) {
			$mail->setTo(array($survey->getContact()->getEmail()));
			$mail->send();
		}

		$this->persistenceManager->persistAll();
	}

	/**
	 * @param \Famelo\Satisfy\Domain\Model\Survey $survey
	 * @return void
	 */
	public function completeAction($survey) {}
}

?>