<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619184155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE messenger_messages_id_seq CASCADE');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE recette ADD tags VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE recette DROP publie');
        $this->addSql('ALTER TABLE recette DROP user_id');
        $this->addSql('ALTER TABLE recette ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE recette ALTER etapes SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE messenger_messages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_75ea56e0e3bd61ce ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX idx_75ea56e0fb7336f0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX idx_75ea56e016ba31db ON messenger_messages (delivered_at)');
        $this->addSql('ALTER TABLE recette ADD publie BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE recette ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE recette DROP tags');
        $this->addSql('CREATE SEQUENCE recette_id_seq');
        $this->addSql('SELECT setval(\'recette_id_seq\', (SELECT MAX(id) FROM recette))');
        $this->addSql('ALTER TABLE recette ALTER id SET DEFAULT nextval(\'recette_id_seq\')');
        $this->addSql('ALTER TABLE recette ALTER etapes DROP NOT NULL');
    }
}
