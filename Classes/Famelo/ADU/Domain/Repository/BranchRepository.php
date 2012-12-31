<?php
namespace Famelo\ADU\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.ADU".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Groups
 *
 * @Flow\Scope("singleton")
 */
class BranchRepository extends \TYPO3\Flow\Persistence\Repository {
	public function getOrCreate($name) {
		$branch = $this->findOneByName($name);
		if ($branch === NULL) {
			$branch = new \Famelo\ADU\Domain\Model\Branch();
			$branch->setName($name);
			$this->add($branch);
		}
		return $branch;
	}
}
?>