<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230824142034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE party_guest (party_id INT NOT NULL, guest_id INT NOT NULL, PRIMARY KEY(party_id, guest_id))');
        $this->addSql('CREATE INDEX IDX_B372BA9A213C1059 ON party_guest (party_id)');
        $this->addSql('CREATE INDEX IDX_B372BA9A9A4AA658 ON party_guest (guest_id)');
        $this->addSql('CREATE TABLE party_product (party_id INT NOT NULL, product_id INT NOT NULL, PRIMARY KEY(party_id, product_id))');
        $this->addSql('CREATE INDEX IDX_C1BB9B86213C1059 ON party_product (party_id)');
        $this->addSql('CREATE INDEX IDX_C1BB9B864584665A ON party_product (product_id)');
        $this->addSql('ALTER TABLE party_guest ADD CONSTRAINT FK_B372BA9A213C1059 FOREIGN KEY (party_id) REFERENCES party (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE party_guest ADD CONSTRAINT FK_B372BA9A9A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE party_product ADD CONSTRAINT FK_C1BB9B86213C1059 FOREIGN KEY (party_id) REFERENCES party (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE party_product ADD CONSTRAINT FK_C1BB9B864584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE party_guest DROP CONSTRAINT FK_B372BA9A213C1059');
        $this->addSql('ALTER TABLE party_guest DROP CONSTRAINT FK_B372BA9A9A4AA658');
        $this->addSql('ALTER TABLE party_product DROP CONSTRAINT FK_C1BB9B86213C1059');
        $this->addSql('ALTER TABLE party_product DROP CONSTRAINT FK_C1BB9B864584665A');
        $this->addSql('DROP TABLE party_guest');
        $this->addSql('DROP TABLE party_product');
    }
}
