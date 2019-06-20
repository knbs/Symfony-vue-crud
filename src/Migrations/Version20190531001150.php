<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190531001150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shoes CHANGE brand brand VARCHAR(50) NOT NULL, CHANGE model model VARCHAR(50) NOT NULL, CHANGE price price VARCHAR(50) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX brand_model_ukey ON shoes (brand, model)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX brand_model_ukey ON shoes');
        $this->addSql('ALTER TABLE shoes CHANGE brand brand VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE model model VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE price price VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
