<?php
namespace Famelo\Satisfy\ViewHelpers;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.Expose".          *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 */
class RatingSumViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * The reportService
	 *
	 * @var \Famelo\Satisfy\Services\ReportService
	 * @Flow\Inject
	 */
	protected $reportService;

	/**
	 * @param object $customer
	 * @return string Rendered string
	 */
	public function render($customer) {
		return $this->reportService->getScore($customer);
	}
}

?>