<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230317162655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coupons DROP created_date');
        $this->addSql('ALTER TABLE orders DROP created_date');
        $this->addSql('ALTER TABLE products DROP created_date');
        $this->addSql('ALTER TABLE users DROP created_date');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD created_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE orders ADD created_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE coupons ADD created_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE users ADD created_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
