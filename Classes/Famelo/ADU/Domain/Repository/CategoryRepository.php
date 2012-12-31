<?php
namespace Famelo\ADU\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.ADU".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Categories
 *
 * @Flow\Scope("singleton")
 */
class CategoryRepository extends \TYPO3\Flow\Persistence\Repository {

	public function getOrCreate($name) {
		$category = $this->findOneByName($name);
		if ($category === NULL) {
			$category = new \Famelo\ADU\Domain\Model\Category();
			$category->setName($name);
			$this->add($category);
		}
		return $category;
	}

}
?>