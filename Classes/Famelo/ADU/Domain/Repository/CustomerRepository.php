<?php
namespace Famelo\ADU\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.ADU".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Customers
 *
 * @Flow\Scope("singleton")
 */
class CustomerRepository extends \TYPO3\Flow\Persistence\Repository {
	/**
	 * The securityContext
	 *
	 * @var \TYPO3\Flow\Security\Context
	 * @Flow\Inject
	 */
	protected $securityContext;

	/**
	 * Returns a query for objects of this repository
	 *
	 * @return \TYPO3\Flow\Persistence\QueryInterface
	 * @api
	 */
	public function createQuery($filtered = TRUE) {
		$query = parent::createQuery();
		if ($filtered === TRUE) {
			if (PHP_SAPI === 'cli') {
				// Full Access
			} elseif ($this->securityContext->hasRole('Administrator')) {
				// Full Access
			} elseif ($this->securityContext->hasRole('Bereichsleiter')) {
				$query->matching($query->equals('branch', $this->securityContext->getParty()->getBranch()));
			} else {
				$query->matching($query->equals('consultant', $this->securityContext->getParty()));
			}
		}
		return $query;
	}

	public function findUnsatisfied() {
		$query = $this->createQuery();
		$query->setOrderings(array(
			'selfEvaluationResult' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING
		));
		$query->matching($query->greaterThan('selfEvaluationResult', 1));
		return $query->execute();
	}

}
?>