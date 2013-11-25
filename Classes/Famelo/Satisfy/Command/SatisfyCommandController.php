<?php
namespace Famelo\Satisfy\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Satisfy".            *
 *                                                                        *
 *                                                                        */

use DavidBadura\Fixtures\FixtureManager\FixtureManager;
use Famelo\Common\Command\AbstractInteractiveCommandController;
use Famelo\Common\Utilities\Settings;
use Famelo\Messaging\Message;
use Famelo\Satisfy\Domain\Model\User;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Party\Domain\Model\PersonName;

/**
 * satisfy command controller for the Famelo.Satisfy package
 *
 * @Flow\Scope("singleton")
 */
class SatisfyCommandController extends AbstractInteractiveCommandController {

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
	 * @var \Famelo\Satisfy\Domain\Repository\UserRepository
	 */
	protected $userRepository;


	/**
	 * @Flow\Inject
	 * @var \Famelo\Satisfy\Domain\Repository\CampaignRepository
	 */
	protected $campaignRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager;

	/**
	 * @Flow\Inject
	 * @var \Doctrine\Common\Persistence\ObjectManager
	 */
	protected $entityManager;

	/**
	 * @var \Famelo\Satisfy\Services\MailSurveyService
	 * @Flow\Inject
	 */
	protected $mailSurveyService;

	/**
	 * Create a new User for the Satisfy Package
	 *
	 * @return void
	 */
	public function createUserCommand() {
		$roles = array('Famelo.Satisfy:Administrator');
		$authenticationProviderName = 'SatisfyProvider';

        $username = $this->ask('Username: ');
        $password = $this->askHiddenResponse('Password: ');
        $email = $this->ask('Email: ');
        $firstName = $this->ask('Firstname: ');
        $lastName = $this->ask('Lastname: ');

        $name = new PersonName();
        $name->firstName($firstName);
        $name->lastName($lastName);

		$user = new User(FALSE);
		$user->setEmail($email);
		$user->setName($name);
		$this->userRepository->add($user);
		$this->persistenceManager->persistAll();

		$account = $this->accountFactory->createAccountWithPassword($username, $password, $roles, $authenticationProviderName);
		$this->accountRepository->add($account);

		$user->addAccount($account);
		$this->userRepository->update($user);
	}

	public function sendMailSurveysCommand() {
		$campaigns = $this->campaignRepository->findAll();
		$now = new \DateTime();

		foreach ($campaigns as $campaign) {
			if ($now < $campaign->getStart()) {
				continue;
			}

			$this->mailSurveyService->prepare($campaign);

			foreach ($campaign->getMailSurveys() as $survey) {
				if ($survey->getSent() === NULL) {
					echo 'Sending mail to: ' . $survey->getContact()->getEmail() . chr(10);
					$message = new Message();
					$message->setFrom(Settings::get('Famelo.Satisfy.Email'))
						->setTo(array($survey->getContact()->getEmail()))
						->setSubject($campaign->getSubject())
						->setTemplateSource($campaign->getBody())
						->assign('campaign', $campaign)
						->assign('survey', $survey)
						->send();
					usleep(1000000 + 0.05);

					$survey->setSent($now);
					$this->persistenceManager->update($survey);
					$this->persistenceManager->persistAll();
				}
			}
		}
	}
}

?>