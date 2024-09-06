<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240906133613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE loan_entity (id INT NOT NULL, modified_by_id INT DEFAULT NULL, installments INT NOT NULL, amount BIGINT NOT NULL, interest INT NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F5ABB11599049ECE ON loan_entity (modified_by_id)');
        $this->addSql('CREATE TABLE loan_schedule (id INT NOT NULL, loan_id_id INT DEFAULT NULL, nr INT NOT NULL, amount BIGINT NOT NULL, interest BIGINT NOT NULL, fund BIGINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D7EEB5028FD8608 ON loan_schedule (loan_id_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON "user" (username)');
        $this->addSql('ALTER TABLE loan_entity ADD CONSTRAINT FK_F5ABB11599049ECE FOREIGN KEY (modified_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE loan_schedule ADD CONSTRAINT FK_D7EEB5028FD8608 FOREIGN KEY (loan_id_id) REFERENCES loan_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE loan_entity DROP CONSTRAINT FK_F5ABB11599049ECE');
        $this->addSql('ALTER TABLE loan_schedule DROP CONSTRAINT FK_D7EEB5028FD8608');
        $this->addSql('DROP TABLE loan_entity');
        $this->addSql('DROP TABLE loan_schedule');
        $this->addSql('DROP TABLE "user"');
    }
}
