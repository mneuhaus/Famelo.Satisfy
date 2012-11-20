<?php
namespace Famelo\ADU\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.ADU".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Answer
 *
 * @Flow\Entity
 */
class Answer {

	/**
	 * The survey
	 * @var \Famelo\ADU\Domain\Model\Survey
	 * @ORM\ManyToOne(inversedBy="answers", cascade={"all"})
	 */
	protected $survey;

	/**
	 * The question
	 * @var \Famelo\ADU\Domain\Model\Question
	 * @ORM\ManyToOne(inversedBy="answers", cascade={"all"})
	 */
	protected $question;

	/**
	 * The answer
	 * @var string
	 */
	protected $answer;

	/**
	 * The comment
	 * @var string
	 */
	protected $comment = '';

	public function __toString() {
		if (is_object($this->question)) {
			return $this->question->getBody();
		} else {
			return '';
		}
	}

	/**
	 * Get the Answer's question
	 *
	 * @return \Famelo\ADU\Domain\Model\Question The Answer's question
	 */
	public function getQuestion() {
		return $this->question;
	}

	/**
	 * Sets this Answer's question
	 *
	 * @param \Famelo\ADU\Domain\Model\Question $question The Answer's question
	 * @return void
	 */
	public function setQuestion($question) {
		$this->question = $question;
	}

	/**
	 * Get the Answer's answer
	 *
	 * @return string The Answer's answer
	 */
	public function getAnswer() {
		return $this->answer;
	}

	/**
	 * Sets this Answer's answer
	 *
	 * @param string $answer The Answer's answer
	 * @return void
	 */
	public function setAnswer($answer) {
		$this->answer = $answer;
	}

	/**
	 * Get the Answer's comment
	 *
	 * @return string The Answer's comment
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * Sets this Answer's comment
	 *
	 * @param string $comment The Answer's comment
	 * @return void
	 */
	public function setComment($comment) {
		$this->comment = $comment;
	}

	/**
	 * @param \Famelo\ADU\Domain\Model\Survey $survey
	 */
	public function setSurvey($survey) {
		$this->survey = $survey;
	}

	/**
	 * @return \Famelo\ADU\Domain\Model\Survey
	 */
	public function getSurvey() {
		return $this->survey;
	}
}
?>