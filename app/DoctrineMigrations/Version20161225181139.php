<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161225181139 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users_educations (user_id INT NOT NULL, education_id INT NOT NULL, INDEX IDX_A463D939A76ED395 (user_id), INDEX IDX_A463D9392CA1BD71 (education_id), PRIMARY KEY(user_id, education_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_educations ADD CONSTRAINT FK_A463D939A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE users_educations ADD CONSTRAINT FK_A463D9392CA1BD71 FOREIGN KEY (education_id) REFERENCES education (id)');
        $this->addSql('ALTER TABLE education ADD resume LONGTEXT DEFAULT NULL, CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE users_educations');
        $this->addSql('ALTER TABLE education DROP resume, CHANGE title title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE description description VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
