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
class CustomerController extends \TYPO3\Flow\Mvc\Controller\ActionController {
	/**
	 * Index action
	 *
	 * @return void
	 */
	public function indexAction() {}

	/**
	 * Index action
	 *
	 * @param \Famelo\Satisfy\Domain\Model\Customer $customer
	 * @return void
	 */
	public function showAction($customer) {
		$this->view->assign('customer', $customer);
	}
}

?>