<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20121104124500 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE TABLE famelo_adu_domain_model_branch_questions_join (adu_branch VARCHAR(40) NOT NULL, adu_question VARCHAR(40) NOT NULL, INDEX IDX_E5814B4BE7496B86 (adu_branch), INDEX IDX_E5814B4B467155EE (adu_question), PRIMARY KEY(adu_branch, adu_question)) ENGINE = InnoDB");
		$this->addSql("ALTER TABLE famelo_adu_domain_model_branch_questions_join ADD CONSTRAINT FK_E5814B4BE7496B86 FOREIGN KEY (adu_branch) REFERENCES famelo_adu_domain_model_branch (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_adu_domain_model_branch_questions_join ADD CONSTRAINT FK_E5814B4B467155EE FOREIGN KEY (adu_question) REFERENCES famelo_adu_domain_model_question (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_adu_domain_model_branch DROP questions, CHANGE branch branch VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE famelo_adu_domain_model_branch ADD CONSTRAINT FK_C1CE0AC9BB861B1F FOREIGN KEY (branch) REFERENCES famelo_adu_domain_model_branch (persistence_object_identifier)");
		$this->addSql("CREATE INDEX IDX_C1CE0AC9BB861B1F ON famelo_adu_domain_model_branch (branch)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("DROP TABLE famelo_adu_domain_model_branch_questions_join");
		$this->addSql("ALTER TABLE famelo_adu_domain_model_branch DROP FOREIGN KEY FK_C1CE0AC9BB861B1F");
		$this->addSql("DROP INDEX IDX_C1CE0AC9BB861B1F ON famelo_adu_domain_model_branch");
		$this->addSql("ALTER TABLE famelo_adu_domain_model_branch ADD questions LONGTEXT NOT NULL COMMENT '(DC2Type:array)', CHANGE branch branch VARCHAR(255) NOT NULL");
	}
}

?>