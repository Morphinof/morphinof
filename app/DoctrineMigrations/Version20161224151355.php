<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161224151355 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, firstName VARCHAR(255) NOT NULL, lastName VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(50) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8157AA0FE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fos_user ADD profile_id INT DEFAULT NULL, DROP profession');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479CCFA12B8 ON fos_user (profile_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479CCFA12B8');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP INDEX UNIQ_957A6479CCFA12B8 ON fos_user');
        $this->addSql('ALTER TABLE fos_user ADD profession VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, DROP profile_id');
    }
}
