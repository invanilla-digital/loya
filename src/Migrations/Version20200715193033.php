<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715193033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('ALTER TABLE customer_addresses ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer_addresses ADD CONSTRAINT FK_C4378D0CB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer_addresses ADD CONSTRAINT FK_C4378D0C896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C4378D0CB03A8386 ON customer_addresses (created_by_id)');
        $this->addSql('CREATE INDEX IDX_C4378D0C896DBBDE ON customer_addresses (updated_by_id)');
        $this->addSql('ALTER TABLE customer_consents ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer_consents ADD CONSTRAINT FK_2A1F8E48B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer_consents ADD CONSTRAINT FK_2A1F8E48896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2A1F8E48B03A8386 ON customer_consents (created_by_id)');
        $this->addSql('CREATE INDEX IDX_2A1F8E48896DBBDE ON customer_consents (updated_by_id)');
        $this->addSql('ALTER TABLE customers ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customers ADD CONSTRAINT FK_62534E21B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customers ADD CONSTRAINT FK_62534E21896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_62534E21B03A8386 ON customers (created_by_id)');
        $this->addSql('CREATE INDEX IDX_62534E21896DBBDE ON customers (updated_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('ALTER TABLE customer_addresses DROP FOREIGN KEY FK_C4378D0CB03A8386');
        $this->addSql('ALTER TABLE customer_addresses DROP FOREIGN KEY FK_C4378D0C896DBBDE');
        $this->addSql('DROP INDEX IDX_C4378D0CB03A8386 ON customer_addresses');
        $this->addSql('DROP INDEX IDX_C4378D0C896DBBDE ON customer_addresses');
        $this->addSql('ALTER TABLE customer_addresses DROP created_by_id, DROP updated_by_id');
        $this->addSql('ALTER TABLE customer_consents DROP FOREIGN KEY FK_2A1F8E48B03A8386');
        $this->addSql('ALTER TABLE customer_consents DROP FOREIGN KEY FK_2A1F8E48896DBBDE');
        $this->addSql('DROP INDEX IDX_2A1F8E48B03A8386 ON customer_consents');
        $this->addSql('DROP INDEX IDX_2A1F8E48896DBBDE ON customer_consents');
        $this->addSql('ALTER TABLE customer_consents DROP created_by_id, DROP updated_by_id');
        $this->addSql('ALTER TABLE customers DROP FOREIGN KEY FK_62534E21B03A8386');
        $this->addSql('ALTER TABLE customers DROP FOREIGN KEY FK_62534E21896DBBDE');
        $this->addSql('DROP INDEX IDX_62534E21B03A8386 ON customers');
        $this->addSql('DROP INDEX IDX_62534E21896DBBDE ON customers');
        $this->addSql('ALTER TABLE customers DROP created_by_id, DROP updated_by_id');
    }
}
