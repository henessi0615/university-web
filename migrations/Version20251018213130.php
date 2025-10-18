<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251018213130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add gender column to students table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE students ADD gender VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE students DROP gender');
    }
}
