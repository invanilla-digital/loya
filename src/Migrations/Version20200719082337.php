<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200719082337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add campaign entities';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql(
            'CREATE TABLE campaigns (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, start_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E3737470B03A8386 (created_by_id), INDEX IDX_E3737470896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE campaign_entries (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', campaign_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, customer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', consent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_85422FE9F639F774 (campaign_id), INDEX IDX_85422FE9B03A8386 (created_by_id), INDEX IDX_85422FE9896DBBDE (updated_by_id), INDEX IDX_85422FE99395C3F3 (customer_id), UNIQUE INDEX UNIQ_85422FE941079D63 (consent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE campaigns ADD CONSTRAINT FK_E3737470B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)'
        );
        $this->addSql(
            'ALTER TABLE campaigns ADD CONSTRAINT FK_E3737470896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)'
        );
        $this->addSql(
            'ALTER TABLE campaign_entries ADD CONSTRAINT FK_85422FE9F639F774 FOREIGN KEY (campaign_id) REFERENCES campaigns (id)'
        );
        $this->addSql(
            'ALTER TABLE campaign_entries ADD CONSTRAINT FK_85422FE9B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)'
        );
        $this->addSql(
            'ALTER TABLE campaign_entries ADD CONSTRAINT FK_85422FE9896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)'
        );
        $this->addSql(
            'ALTER TABLE campaign_entries ADD CONSTRAINT FK_85422FE99395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)'
        );
        $this->addSql(
            'ALTER TABLE campaign_entries ADD CONSTRAINT FK_85422FE941079D63 FOREIGN KEY (consent_id) REFERENCES customer_consents (id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE campaign_entries DROP FOREIGN KEY FK_85422FE9F639F774');
        $this->addSql('DROP TABLE campaigns');
        $this->addSql('DROP TABLE campaign_entries');
    }
}
