<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251022175157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add courses table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE courses (code VARCHAR(16) NOT NULL, title VARCHAR(60) NOT NULL, description VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY (code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE courses');
    }
}
