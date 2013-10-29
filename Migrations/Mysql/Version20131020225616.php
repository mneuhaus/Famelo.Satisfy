<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20131020225616 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_answer (persistence_object_identifier VARCHAR(40) NOT NULL, survey VARCHAR(40) DEFAULT NULL, question VARCHAR(40) DEFAULT NULL, answer VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, note VARCHAR(255) NOT NULL, INDEX IDX_D73FE568AD5F9BFC (survey), INDEX IDX_D73FE568B6F7494E (question), PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_branch (persistence_object_identifier VARCHAR(40) NOT NULL, parent_branch_id VARCHAR(40) DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_B664B4522D9DE3A7 (parent_branch_id), PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_branch_questions_join (satisfy_branch VARCHAR(40) NOT NULL, satisfy_question VARCHAR(40) NOT NULL, INDEX IDX_AB371C28C6C49158 (satisfy_branch), INDEX IDX_AB371C284A287F0 (satisfy_question), PRIMARY KEY(satisfy_branch, satisfy_question)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_category (persistence_object_identifier VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_contact (persistence_object_identifier VARCHAR(40) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_customer (persistence_object_identifier VARCHAR(40) NOT NULL, contact VARCHAR(40) DEFAULT NULL, alternativecontact VARCHAR(40) DEFAULT NULL, category VARCHAR(40) DEFAULT NULL, consultant VARCHAR(40) DEFAULT NULL, branch VARCHAR(40) DEFAULT NULL, name VARCHAR(255) NOT NULL, object VARCHAR(255) NOT NULL, cycle INT NOT NULL, cyclestart DATETIME DEFAULT NULL, created DATETIME NOT NULL, termination DATETIME DEFAULT NULL, selfevaluationresult DOUBLE PRECISION NOT NULL, satisfaction DOUBLE PRECISION NOT NULL, INDEX IDX_82870CDA4C62E638 (contact), INDEX IDX_82870CDA16C72839 (alternativecontact), INDEX IDX_82870CDA64C19C1 (category), INDEX IDX_82870CDA441282A1 (consultant), INDEX IDX_82870CDABB861B1F (branch), PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_question (persistence_object_identifier VARCHAR(40) NOT NULL, body VARCHAR(255) NOT NULL, weight DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_rating (persistence_object_identifier VARCHAR(40) NOT NULL, customer VARCHAR(40) DEFAULT NULL, action VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, created DATETIME NOT NULL, date DATETIME NOT NULL, level INT NOT NULL, INDEX IDX_D56B896F81398E09 (customer), PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_survey (persistence_object_identifier VARCHAR(40) NOT NULL, customer VARCHAR(40) DEFAULT NULL, contact VARCHAR(40) DEFAULT NULL, rating VARCHAR(40) DEFAULT NULL, created DATETIME NOT NULL, moresecurity TINYINT(1) NOT NULL, moreservice TINYINT(1) NOT NULL, INDEX IDX_A0BD34B181398E09 (customer), INDEX IDX_A0BD34B14C62E638 (contact), UNIQUE INDEX UNIQ_A0BD34B1D8892622 (rating), PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_survey_answers_join (satisfy_survey VARCHAR(40) NOT NULL, satisfy_answer VARCHAR(40) NOT NULL, INDEX IDX_94A6C3E8D01D11BB (satisfy_survey), INDEX IDX_94A6C3E8A79FC062 (satisfy_answer), PRIMARY KEY(satisfy_survey, satisfy_answer)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE famelo_satisfy_domain_model_user (persistence_object_identifier VARCHAR(40) NOT NULL, branch VARCHAR(40) DEFAULT NULL, phone VARCHAR(255) NOT NULL, origin VARCHAR(255) NOT NULL, mobile VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, INDEX IDX_2D7EA395BB861B1F (branch), PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_answer ADD CONSTRAINT FK_D73FE568AD5F9BFC FOREIGN KEY (survey) REFERENCES famelo_satisfy_domain_model_survey (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_answer ADD CONSTRAINT FK_D73FE568B6F7494E FOREIGN KEY (question) REFERENCES famelo_satisfy_domain_model_question (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_branch ADD CONSTRAINT FK_B664B4522D9DE3A7 FOREIGN KEY (parent_branch_id) REFERENCES famelo_satisfy_domain_model_branch (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_branch_questions_join ADD CONSTRAINT FK_AB371C28C6C49158 FOREIGN KEY (satisfy_branch) REFERENCES famelo_satisfy_domain_model_branch (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_branch_questions_join ADD CONSTRAINT FK_AB371C284A287F0 FOREIGN KEY (satisfy_question) REFERENCES famelo_satisfy_domain_model_question (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_customer ADD CONSTRAINT FK_82870CDA4C62E638 FOREIGN KEY (contact) REFERENCES famelo_satisfy_domain_model_contact (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_customer ADD CONSTRAINT FK_82870CDA16C72839 FOREIGN KEY (alternativecontact) REFERENCES famelo_satisfy_domain_model_contact (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_customer ADD CONSTRAINT FK_82870CDA64C19C1 FOREIGN KEY (category) REFERENCES famelo_satisfy_domain_model_category (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_customer ADD CONSTRAINT FK_82870CDA441282A1 FOREIGN KEY (consultant) REFERENCES famelo_satisfy_domain_model_user (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_customer ADD CONSTRAINT FK_82870CDABB861B1F FOREIGN KEY (branch) REFERENCES famelo_satisfy_domain_model_branch (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_rating ADD CONSTRAINT FK_D56B896F81398E09 FOREIGN KEY (customer) REFERENCES famelo_satisfy_domain_model_customer (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_survey ADD CONSTRAINT FK_A0BD34B181398E09 FOREIGN KEY (customer) REFERENCES famelo_satisfy_domain_model_customer (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_survey ADD CONSTRAINT FK_A0BD34B14C62E638 FOREIGN KEY (contact) REFERENCES famelo_satisfy_domain_model_contact (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_survey ADD CONSTRAINT FK_A0BD34B1D8892622 FOREIGN KEY (rating) REFERENCES famelo_satisfy_domain_model_rating (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_survey_answers_join ADD CONSTRAINT FK_94A6C3E8D01D11BB FOREIGN KEY (satisfy_survey) REFERENCES famelo_satisfy_domain_model_survey (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_survey_answers_join ADD CONSTRAINT FK_94A6C3E8A79FC062 FOREIGN KEY (satisfy_answer) REFERENCES famelo_satisfy_domain_model_answer (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_user ADD CONSTRAINT FK_2D7EA395BB861B1F FOREIGN KEY (branch) REFERENCES famelo_satisfy_domain_model_branch (persistence_object_identifier)");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_user ADD CONSTRAINT FK_2D7EA39547A46B0A FOREIGN KEY (persistence_object_identifier) REFERENCES typo3_party_domain_model_abstractparty (persistence_object_identifier) ON DELETE CASCADE");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_survey_answers_join DROP FOREIGN KEY FK_94A6C3E8A79FC062");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_branch DROP FOREIGN KEY FK_B664B4522D9DE3A7");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_branch_questions_join DROP FOREIGN KEY FK_AB371C28C6C49158");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_customer DROP FOREIGN KEY FK_82870CDABB861B1F");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_user DROP FOREIGN KEY FK_2D7EA395BB861B1F");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_customer DROP FOREIGN KEY FK_82870CDA64C19C1");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_customer DROP FOREIGN KEY FK_82870CDA4C62E638");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_customer DROP FOREIGN KEY FK_82870CDA16C72839");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_survey DROP FOREIGN KEY FK_A0BD34B14C62E638");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_rating DROP FOREIGN KEY FK_D56B896F81398E09");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_survey DROP FOREIGN KEY FK_A0BD34B181398E09");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_answer DROP FOREIGN KEY FK_D73FE568B6F7494E");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_branch_questions_join DROP FOREIGN KEY FK_AB371C284A287F0");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_survey DROP FOREIGN KEY FK_A0BD34B1D8892622");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_answer DROP FOREIGN KEY FK_D73FE568AD5F9BFC");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_survey_answers_join DROP FOREIGN KEY FK_94A6C3E8D01D11BB");
		$this->addSql("ALTER TABLE famelo_satisfy_domain_model_customer DROP FOREIGN KEY FK_82870CDA441282A1");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_answer");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_branch");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_branch_questions_join");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_category");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_contact");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_customer");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_question");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_rating");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_survey");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_survey_answers_join");
		$this->addSql("DROP TABLE famelo_satisfy_domain_model_user");
	}
}

?>