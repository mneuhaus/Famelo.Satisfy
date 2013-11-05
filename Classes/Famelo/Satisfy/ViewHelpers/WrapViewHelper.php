<?php
namespace Famelo\Satisfy\ViewHelpers;

/*                                                                        *
 * This script belongs to the FLOW3 package "Blog".                       *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License as published by the Free   *
 * Software Foundation, either version 3 of the License, or (at your      *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        *
 * You should have received a copy of the GNU General Public License      *
 * along with the script.                                                 *
 * If not, see http://www.gnu.org/licenses/gpl.html                       *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 *
 */
class WrapViewHelper  extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {


	/**
	 * @param object $object
	 * @param string $wrapper
	 * @param string $as
	 * @return string Rendered string
	 */
	public function render($object, $wrapper, $as) {
		$this->templateVariableContainer->add($as, new $wrapper($object));
		$output = $this->renderChildren();
		$this->templateVariableContainer->remove($as);
		return $output;
	}
}


?>