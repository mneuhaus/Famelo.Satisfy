<?php
namespace Famelo\ADU\Domain\Repository;

/*                                                                        *
 * This script belongs to the FLOW3 package "Brain".                      *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Users
 *
 * @Flow\Scope("singleton")
 */
class UserRepository extends \TYPO3\Flow\Persistence\Repository {
	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountRepository
	 */
	protected $accountRepository;

	public function findOneByUsername($username) {
		$account = $this->accountRepository->findByAccountIdentifierAndAuthenticationProviderName($username, 'ADUProvider');
		return $account->getParty();
	}
}
?>