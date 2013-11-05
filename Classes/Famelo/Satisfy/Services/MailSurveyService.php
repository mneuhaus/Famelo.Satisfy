<?php
namespace Famelo\Satisfy\Services;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.Expose".               *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Famelo\Satisfy\Domain\Model\MailSurvey;
use Famelo\Satisfy\Domain\Model\Result;
use TYPO3\Flow\Annotations as Flow;

/**
 *
 * @Flow\Scope("singleton")
 */
class MailSurveyService {
	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager;

	public function prepare($campaign) {
		$contacts = array();
		foreach ($campaign->getContacts() as $contact) {
			$contacts[$this->persistenceManager->getIdentifierByObject($contact)] = $contact;
		}
		foreach ($campaign->getCustomers() as $customer) {
			foreach ($customer->getContacts() as $contact) {

				$contacts[$this->persistenceManager->getIdentifierByObject($contact)] = $contact;
			}
		}

		foreach ($contacts as $contact) {
			$mailSurvey = new MailSurvey();
			$mailSurvey->setContact($contact);
			$mailSurvey->setCampaign($campaign);
			$this->persistenceManager->add($mailSurvey);
		}
		$this->persistenceManager->persistAll();
	}
}
?>