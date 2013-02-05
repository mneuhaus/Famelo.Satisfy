<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130124161056 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE famelo_adu_domain_model_survey ADD contact VARCHAR(40) DEFAULT NULL, DROP contactperson");
		$this->addSql("ALTER TABLE famelo_adu_domain_model_survey ADD CONSTRAINT FK_D7178A2A4C62E638 FOREIGN KEY (contact) REFERENCES famelo_adu_domain_model_contact (persistence_object_identifier)");
		$this->addSql("CREATE INDEX IDX_D7178A2A4C62E638 ON famelo_adu_domain_model_survey (contact)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE famelo_adu_domain_model_survey DROP FOREIGN KEY FK_D7178A2A4C62E638");
		$this->addSql("DROP INDEX IDX_D7178A2A4C62E638 ON famelo_adu_domain_model_survey");
		$this->addSql("ALTER TABLE famelo_adu_domain_model_survey ADD contactperson VARCHAR(255) NOT NULL, DROP contact");
	}
}

?>