<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220419154729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course RENAME COLUMN character_code TO symbolic_code');
        $this->addSql('ALTER TABLE lesson RENAME COLUMN lesson_content TO content');
        $this->addSql('ALTER TABLE lesson RENAME COLUMN serial_number TO number');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE course RENAME COLUMN symbolic_code TO character_code');
        $this->addSql('ALTER TABLE lesson RENAME COLUMN content TO lesson_content');
        $this->addSql('ALTER TABLE lesson RENAME COLUMN number TO serial_number');
    }
}
