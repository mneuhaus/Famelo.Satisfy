<?php
namespace Famelo\Satisfy\Controller\Campaign;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.Expose".          *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Expose\Controller\AbstractController;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Error\Message;

/**
 * Action to Update the Being
 *
 */
class EditController extends AbstractController {

	/**
	 * @return void
	 */
	public function initializeIndexAction() {
		$this->arguments['objects']->setDataType('Doctrine\Common\Collections\Collection<' . $this->request->getArgument('type') . '>');
		$this->arguments['objects']->getPropertyMappingConfiguration()->allowAllProperties();
	}

	/**
	 * Edit object
	 *
	 * @param string $type
	 * @param \Doctrine\Common\Collections\Collection $objects
	 * @return void
	 */
	public function indexAction($type, $objects) {
		$this->view->assign('className', $type);
		$this->view->assign('objects', $objects);
		$this->view->assign('callbackAction', 'update');
		foreach ($objects->first()->getMailSurveys() as $mailSurvey) {
			if ($mailSurvey->getSent() !== NULL) {
				$this->addFlashMessage('Diese Kampagne kann nicht mehr bearbeitet werden, da Sie bereits versandt wurde.', '', Message::SEVERITY_WARNING);
				$this->redirect('index', 'Index');
			}
		}
		$this->redirect('index', 'Edit', 'TYPO3.Expose', array('type' => $type, 'objects' => $objects));
	}

	/**
	 * @param string $type
	 * @return void
	 */
	public function updateAction($type) {
		$objects = $this->request->getInternalArgument('__objects');
		foreach ($objects as $object) {
			if (!$this->persistenceManager->isNewObject($object)) {
				$this->persistenceManager->update($object);
			}
		}
		$this->persistenceManager->persistAll();
		$this->redirect('index', 'list', 'TYPO3.Expose', array('type' => $type));
	}
}
?>