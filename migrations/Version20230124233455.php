<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124233455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "user_table_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE video_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user_table" (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE video (id INT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CF675F31B ON video (author_id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CF675F31B FOREIGN KEY (author_id) REFERENCES "user_table" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "user_table_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE video_id_seq CASCADE');
        $this->addSql('ALTER TABLE video DROP CONSTRAINT FK_7CC7DA2CF675F31B');
        $this->addSql('DROP TABLE "user_table"');
        $this->addSql('DROP TABLE video');
    }
}
