<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251025234642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add relation between courses and teachers table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE courses ADD teacher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4C41807E1D FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_A9A55A4C41807E1D ON courses (teacher_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4C41807E1D');
        $this->addSql('DROP INDEX IDX_A9A55A4C41807E1D ON courses');
        $this->addSql('ALTER TABLE courses DROP teacher_id');
    }
}
