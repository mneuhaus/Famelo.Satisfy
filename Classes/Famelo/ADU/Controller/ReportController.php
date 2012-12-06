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
}

?>