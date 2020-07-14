<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200714162057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add customers, addresses and consents';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql(
            'CREATE TABLE customer_addresses (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', customer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', country_code VARCHAR(255) NOT NULL, administrative_area VARCHAR(255) NOT NULL, locality VARCHAR(255) NOT NULL, dependent_locality VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, sorting_code VARCHAR(255) NOT NULL, address_line1 VARCHAR(255) NOT NULL, address_line2 VARCHAR(255) NOT NULL, organization VARCHAR(255) NOT NULL, given_name VARCHAR(255) NOT NULL, additional_name VARCHAR(255) NOT NULL, family_name VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C4378D0C9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE customer_consents (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', customer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', type VARCHAR(255) NOT NULL, expiry_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2A1F8E489395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE customers (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, personal_code VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE customer_addresses ADD CONSTRAINT FK_C4378D0C9395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)'
        );
        $this->addSql(
            'ALTER TABLE customer_consents ADD CONSTRAINT FK_2A1F8E489395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE customer_addresses DROP FOREIGN KEY FK_C4378D0C9395C3F3');
        $this->addSql('ALTER TABLE customer_consents DROP FOREIGN KEY FK_2A1F8E489395C3F3');
        $this->addSql('DROP TABLE customer_addresses');
        $this->addSql('DROP TABLE customer_consents');
        $this->addSql('DROP TABLE customers');
    }
}
