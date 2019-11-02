<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191102164248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price_et NUMERIC(10, 2) NOT NULL, price_it NUMERIC(10, 2) NOT NULL, tax_rule NUMERIC(5, 3) NOT NULL, enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_B3BA5A5AB03A8386 (created_by_id), INDEX IDX_B3BA5A5A896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE addresses CHANGE alias alias VARCHAR(100) NOT NULL, CHANGE address2 address2 VARCHAR(100) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE gender gender VARCHAR(6) DEFAULT NULL, CHANGE birthday birthday DATETIME DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(10) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE products');
        $this->addSql('ALTER TABLE addresses CHANGE alias alias VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address2 address2 VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE users CHANGE gender gender VARCHAR(6) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE birthday birthday DATETIME DEFAULT \'NULL\', CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE phone_number phone_number VARCHAR(10) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}
