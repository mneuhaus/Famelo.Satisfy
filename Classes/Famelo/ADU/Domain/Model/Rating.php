<?php
namespace Famelo\ADU\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.ADU".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Rating
 *
 * @Flow\Entity
 */
class Rating {

	/**
	 * The created
	 * @var \DateTime
	 */
	protected $created;

	/**
	 * The level
	 * @var integer
	 */
	protected $level;

	/**
	 * The comment
	 * @var string
	 */
	protected $comment;


	/**
	 * Get the Rating's created
	 *
	 * @return \DateTime The Rating's created
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * Sets this Rating's created
	 *
	 * @param \DateTime $created The Rating's created
	 * @return void
	 */
	public function setCreated($created) {
		$this->created = $created;
	}

	/**
	 * Get the Rating's level
	 *
	 * @return integer The Rating's level
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * Sets this Rating's level
	 *
	 * @param integer $level The Rating's level
	 * @return void
	 */
	public function setLevel($level) {
		$this->level = $level;
	}

	/**
	 * Get the Rating's comment
	 *
	 * @return string The Rating's comment
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * Sets this Rating's comment
	 *
	 * @param string $comment The Rating's comment
	 * @return void
	 */
	public function setComment($comment) {
		$this->comment = $comment;
	}

}
?>