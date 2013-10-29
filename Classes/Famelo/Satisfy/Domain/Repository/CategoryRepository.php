<?php
namespace Famelo\Satisfy\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Satisfy".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Categories
 *
 * @Flow\Scope("singleton")
 */
class CategoryRepository extends \TYPO3\Flow\Persistence\Repository {
	protected $cache = array();

	public function getOrCreate($name) {
		$category = $this->findOneByName($name);
		if ($category === NULL) {
			if (isset($this->cache[$name])) {
				return $this->cache[$name];
			}
			$category = new \Famelo\Satisfy\Domain\Model\Category();
			$category->setName($name);
			$this->add($category);
			$this->cache[$name] = $category;
		}
		return $category;
	}

}
?>