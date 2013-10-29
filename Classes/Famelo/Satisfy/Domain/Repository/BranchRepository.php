<?php
namespace Famelo\Satisfy\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Satisfy".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Groups
 *
 * @Flow\Scope("singleton")
 */
class BranchRepository extends \TYPO3\Flow\Persistence\Repository {
	protected $cache = array();

	public function getOrCreate($name) {
		$branch = $this->findOneByName($name);
		if ($branch === NULL) {
			if (isset($this->cache[$name])) {
				return $this->cache[$name];
			}
			$branch = new \Famelo\Satisfy\Domain\Model\Branch();
			$branch->setName($name);
			$this->add($branch);
			$this->cache[$name] = $branch;
		}
		return $branch;
	}
}
?>