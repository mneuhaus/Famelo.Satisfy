<?php
namespace Famelo\ADU\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.ADU".            *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * adu command controller for the Famelo.ADU package
 *
 * @Flow\Scope("singleton")
 */
class AduCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
	 */
	protected $authenticationManager;

	/**
	 * @var \TYPO3\Flow\Security\Cryptography\HashService
	 * @Flow\Inject
	 */
	protected $hashService;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountRepository
	 */
	protected $accountRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountFactory
	 */
	protected $accountFactory;

	/**
	 * @Flow\Inject
	 * @var \Famelo\ADU\Domain\Repository\UserRepository
	 */
	protected $userRepository;

	/**
	 * Create a new User for the ADU Package
	 *
	 * The comment of this command method is also used for TYPO3 Flow's help screens. The first line should give a very short
	 * summary about what the command does. Then, after an empty line, you should explain in more detail what the command
	 * does. You might also give some usage example.
	 *
	 * It is important to document the parameters with param tags, because that information will also appear in the help
	 * screen.
	 *
	 * @param string $username
	 * @param string $password
	 * @return void
	 */
	public function createUserCommand($username, $password) {
		$roles = array('Administrator');
		$authenticationProviderName = 'ADUProvider';

		$account = $this->accountFactory->createAccountWithPassword($username, $password, $roles, $authenticationProviderName);
		$this->accountRepository->add($account);

		#$user = new \Famelo\ADU\Domain\Model\User();
		#$user->addAccount($account);
		#$this->userRepository->add($user);
	}

}

?>