<?php
namespace Famelo\Satisfy\Controller\Campaign;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.Expose".               *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;

/**
 * Action to confirm the deletion of a being
 *
 */
class DetailController extends \TYPO3\Expose\Controller\AbstractController {
	/**
	 * @var \Famelo\Satisfy\Services\MailSurveyService
	 * @Flow\Inject
	 */
	protected $mailSurveyService;

	/**
	 * @return void
	 */
	public function initializeIndexAction() {
		$this->arguments['objects']->setDataType('Doctrine\Common\Collections\Collection<' . $this->request->getArgument('type') . '>');
		$this->arguments['objects']->getPropertyMappingConfiguration()->allowAllProperties();
	}

	/**
	 * delete objects
	 *
	 * @param string $type
	 * @param \Doctrine\Common\Collections\Collection $objects
	 * @return void
	 */
	public function indexAction($type, $objects) {
		$this->view->setTypoScriptPath('CampaignDetail/<Famelo.Satisfy:DetailController>');
		$this->view->assign('className', $type);
		$this->view->assign('objects', $objects);

		// foreach ($objects as $object) {
		// 	$this->mailSurveyService->prepare($object);
		// }
	}
}

?>