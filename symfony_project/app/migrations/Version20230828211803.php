<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230828211803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE bill ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E3F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7A2119E3F675F31B ON bill (author_id)');
        $this->addSql('ALTER TABLE guest ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE guest ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE guest ADD CONSTRAINT FK_ACB79A35F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE guest ADD CONSTRAINT FK_ACB79A35A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_ACB79A35F675F31B ON guest (author_id)');
        $this->addSql('CREATE INDEX IDX_ACB79A35A76ED395 ON guest (user_id)');
        $this->addSql('ALTER TABLE party ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE party ADD CONSTRAINT FK_89954EE0F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_89954EE0F675F31B ON party (author_id)');
        $this->addSql('ALTER TABLE payment ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6D28840DF675F31B ON payment (author_id)');
        $this->addSql('ALTER TABLE product ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04ADF675F31B ON product (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bill DROP CONSTRAINT FK_7A2119E3F675F31B');
        $this->addSql('ALTER TABLE guest DROP CONSTRAINT FK_ACB79A35F675F31B');
        $this->addSql('ALTER TABLE guest DROP CONSTRAINT FK_ACB79A35A76ED395');
        $this->addSql('ALTER TABLE party DROP CONSTRAINT FK_89954EE0F675F31B');
        $this->addSql('ALTER TABLE payment DROP CONSTRAINT FK_6D28840DF675F31B');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADF675F31B');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP INDEX IDX_6D28840DF675F31B');
        $this->addSql('ALTER TABLE payment DROP author_id');
        $this->addSql('DROP INDEX IDX_ACB79A35F675F31B');
        $this->addSql('DROP INDEX IDX_ACB79A35A76ED395');
        $this->addSql('ALTER TABLE guest DROP author_id');
        $this->addSql('ALTER TABLE guest DROP user_id');
        $this->addSql('DROP INDEX IDX_7A2119E3F675F31B');
        $this->addSql('ALTER TABLE bill DROP author_id');
        $this->addSql('DROP INDEX IDX_89954EE0F675F31B');
        $this->addSql('ALTER TABLE party DROP author_id');
        $this->addSql('DROP INDEX IDX_D34A04ADF675F31B');
        $this->addSql('ALTER TABLE product DROP author_id');
    }
}
