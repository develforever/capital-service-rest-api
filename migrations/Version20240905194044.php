<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905194044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE loan_schedule_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE loan_entity (id INT NOT NULL, installments INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, amount BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN loan_entity.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE loan_schedule (id INT NOT NULL, loan_id_id INT DEFAULT NULL, nr INT NOT NULL, amount BIGINT NOT NULL, interest BIGINT NOT NULL, fund BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D7EEB5028FD8608 ON loan_schedule (loan_id_id)');
        $this->addSql('ALTER TABLE loan_schedule ADD CONSTRAINT FK_D7EEB5028FD8608 FOREIGN KEY (loan_id_id) REFERENCES loan_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE loan_schedule_id_seq CASCADE');
        $this->addSql('ALTER TABLE loan_schedule DROP CONSTRAINT FK_D7EEB5028FD8608');
        $this->addSql('DROP TABLE loan_entity');
        $this->addSql('DROP TABLE loan_schedule');
    }
}
