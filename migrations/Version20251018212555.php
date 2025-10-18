<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251018212555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add teachers table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE teachers (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(16) NOT NULL, surname VARCHAR(16) NOT NULL, middlename VARCHAR(16) DEFAULT NULL, birthday_date DATE NOT NULL, gender VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE teachers');
    }
}
