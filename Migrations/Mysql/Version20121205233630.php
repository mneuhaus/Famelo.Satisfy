<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20121205233630 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE foo_bar_domain_model_branch DROP FOREIGN KEY FK_2CF8D4F52D9DE3A7");
		$this->addSql("DROP TABLE foo_bar_domain_model_branch");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE TABLE foo_bar_domain_model_branch (persistence_object_identifier VARCHAR(40) NOT NULL, parent_branch_id VARCHAR(40) DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2CF8D4F52D9DE3A7 (parent_branch_id), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("ALTER TABLE foo_bar_domain_model_branch ADD CONSTRAINT FK_2CF8D4F52D9DE3A7 FOREIGN KEY (parent_branch_id) REFERENCES foo_bar_domain_model_branch (persistence_object_identifier)");
	}
}

?>