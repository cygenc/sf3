<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529224351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE locales (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, name VARCHAR(50) NOT NULL, uuid VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attributes (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, uuid VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attributes_translations (id INT AUTO_INCREMENT NOT NULL, locale_id INT DEFAULT NULL, attribute_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, uuid VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_DEF10ABEE559DFD1 (locale_id), INDEX IDX_DEF10ABEB6E62EFA (attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attributes_translations ADD CONSTRAINT FK_DEF10ABEE559DFD1 FOREIGN KEY (locale_id) REFERENCES locales (id)');
        $this->addSql('ALTER TABLE attributes_translations ADD CONSTRAINT FK_DEF10ABEB6E62EFA FOREIGN KEY (attribute_id) REFERENCES attributes (id)');
        $this->addSql('ALTER TABLE users CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A896DBBDE');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AB03A8386');
        $this->addSql('DROP INDEX IDX_B3BA5A5AB03A8386 ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5A896DBBDE ON products');
        $this->addSql('ALTER TABLE products ADD uuid VARCHAR(255) NOT NULL, DROP created_by_id, DROP updated_by_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attributes_translations DROP FOREIGN KEY FK_DEF10ABEE559DFD1');
        $this->addSql('ALTER TABLE attributes_translations DROP FOREIGN KEY FK_DEF10ABEB6E62EFA');
        $this->addSql('DROP TABLE locales');
        $this->addSql('DROP TABLE attributes');
        $this->addSql('DROP TABLE attributes_translations');
        $this->addSql('ALTER TABLE products ADD created_by_id INT NOT NULL, ADD updated_by_id INT DEFAULT NULL, DROP uuid');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AB03A8386 ON products (created_by_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A896DBBDE ON products (updated_by_id)');
        $this->addSql('ALTER TABLE users CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
