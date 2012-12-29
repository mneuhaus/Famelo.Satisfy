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
class ReportController extends \TYPO3\Flow\Mvc\Controller\ActionController {

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
	public function indexAction() {
		$customers = $this->customerRepository->findAll();
		$this->view->assign('customers', $customers);
	}

	/**
	 * Index action
	 *
	 * @return void
	 */
	public function surveyAction() {
		$customers = $this->customerRepository->findAll();
		$this->view->assign('customers', $customers);
	}

	/**
	 * Index action
	 *
	 * @return void
	 */
	public function selfEvaluationAction() {
		// $customers = $this->customerRepository->createQuery();
		// $customers->setOrderings(array(
		// 	//'selfEvaluationResult' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING
		// 	'name' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING
		// ));
		// $this->view->assign('customers', $customers->execute());
	}

	/**
	 * Index action
	 *
	 * @param \Famelo\ADU\Domain\Model\Customer $customer
	 * @return void
	 */
	public function customerAction($customer) {
		$this->view->assign('customer', $customer);
	}
}

?>