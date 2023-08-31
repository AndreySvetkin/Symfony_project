<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230807160703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guest_product (guest_id INT NOT NULL, product_id INT NOT NULL, PRIMARY KEY(guest_id, product_id))');
        $this->addSql('CREATE INDEX IDX_938FC0E19A4AA658 ON guest_product (guest_id)');
        $this->addSql('CREATE INDEX IDX_938FC0E14584665A ON guest_product (product_id)');
        $this->addSql('ALTER TABLE guest_product ADD CONSTRAINT FK_938FC0E19A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE guest_product ADD CONSTRAINT FK_938FC0E14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bill ADD guest_id INT NOT NULL');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E39A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7A2119E39A4AA658 ON bill (guest_id)');
        $this->addSql('ALTER TABLE payment ADD create_payment_guest_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment ADD received_payment_guest_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D4A407B19 FOREIGN KEY (create_payment_guest_id) REFERENCES guest (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DF32103BA FOREIGN KEY (received_payment_guest_id) REFERENCES guest (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6D28840D4A407B19 ON payment (create_payment_guest_id)');
        $this->addSql('CREATE INDEX IDX_6D28840DF32103BA ON payment (received_payment_guest_id)');
        $this->addSql('ALTER TABLE product ADD bill_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04AD1A8C12F5 ON product (bill_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE guest_product DROP CONSTRAINT FK_938FC0E19A4AA658');
        $this->addSql('ALTER TABLE guest_product DROP CONSTRAINT FK_938FC0E14584665A');
        $this->addSql('DROP TABLE guest_product');
        $this->addSql('ALTER TABLE bill DROP CONSTRAINT FK_7A2119E39A4AA658');
        $this->addSql('DROP INDEX IDX_7A2119E39A4AA658');
        $this->addSql('ALTER TABLE bill DROP guest_id');
        $this->addSql('ALTER TABLE payment DROP CONSTRAINT FK_6D28840D4A407B19');
        $this->addSql('ALTER TABLE payment DROP CONSTRAINT FK_6D28840DF32103BA');
        $this->addSql('DROP INDEX IDX_6D28840D4A407B19');
        $this->addSql('DROP INDEX IDX_6D28840DF32103BA');
        $this->addSql('ALTER TABLE payment DROP create_payment_guest_id');
        $this->addSql('ALTER TABLE payment DROP received_payment_guest_id');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD1A8C12F5');
        $this->addSql('DROP INDEX IDX_D34A04AD1A8C12F5');
        $this->addSql('ALTER TABLE product DROP bill_id');
    }
}
