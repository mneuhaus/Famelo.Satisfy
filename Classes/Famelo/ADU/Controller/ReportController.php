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
	 * The reportService
	 *
	 * @var \Famelo\ADU\Services\ReportService
	 * @Flow\Inject
	 */
	protected $reportService;

	/**
	 * Index action
	 *
	 * @param string $date
	 * @return void
	 */
	public function indexAction($date = NULL) {
		if ($date !== NULL) {
			$this->reportService->setDateTime(new \DateTime($date));
		}

		$this->view->assign('date', $this->reportService->getDateTime()->format('d.m.Y'));
		$this->view->assign('reportService', $this->reportService);
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
		$this->view->assign('thisWeek', intval($date->format('W')));
		$this->view->assign('lastWeek', intval($date->format('W')) - 1);
		$this->view->assign('twoWeeksAgo', intval($date->format('W')) - 2);
		$this->view->assign('reportService', $this->reportService);
	}

	/**
	 * @param string $date
	 * @return void
	 */
	public function generateSelfEvaluationAction($date) {
		if ($date !== NULL) {
			$this->reportService->setDateTime(new \DateTime($date));
		}

		$document = new \Famelo\PDF\Document('Famelo.ADU:CustomerReport');
		$document->assign('customers', $this->customerRepository->findUnsatisfied());
		$document->download('Bericht ' . date('d.m.Y') . '.pdf');
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

	/**
	 * Index action
	 *
	 * @return void
	 */
	public function overviewAction() {
		$customers = $this->customerRepository->findAll();
		$this->view->assign('customers', $customers);
	}
}

?>