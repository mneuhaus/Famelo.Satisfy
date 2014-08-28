<?php
namespace Famelo\Satisfy\Form\Elements;

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
 * A password with confirmation form element
 */
class FluidEditor extends \TYPO3\Form\Core\Model\AbstractFormElement {

	/**
	 * @param \TYPO3\Form\Core\Runtime\FormRuntime $formRuntime
	 * @param mixed $elementValue
	 * @return void
	 */
	public function onSubmit(\TYPO3\Form\Core\Runtime\FormRuntime $formRuntime, &$elementValue) {
		preg_match_all('/\&lt;\/*[a-z]*:[^\&]*\&gt;/', $elementValue, $matches);
		foreach ($matches[0] as $key => $search) {
			$replace = '<' . substr($search, 4, -4) . '>';
			$elementValue = str_replace($search, $replace, $elementValue);
		}
	}

	public function getDefaultValue() {
		$value = parent::getDefaultValue();
		preg_match_all('/\<\/*[a-z]*:[^\>]*\>/', $value, $matches);
		foreach ($matches[0] as $key => $search) {
			$replace = '&lt;' . trim($search, '<>') . '&gt;';
			$value = str_replace($search, $replace, $value);
		}
		return $value;
	}
}

?>