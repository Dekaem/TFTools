<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907192813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objet ADD premier_item_id INT NOT NULL, ADD second_item_id INT NOT NULL');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38BEA84A98 FOREIGN KEY (premier_item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C3852DD233 FOREIGN KEY (second_item_id) REFERENCES item (id)');
        $this->addSql('CREATE INDEX IDX_46CD4C38BEA84A98 ON objet (premier_item_id)');
        $this->addSql('CREATE INDEX IDX_46CD4C3852DD233 ON objet (second_item_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38BEA84A98');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C3852DD233');
        $this->addSql('DROP INDEX IDX_46CD4C38BEA84A98 ON objet');
        $this->addSql('DROP INDEX IDX_46CD4C3852DD233 ON objet');
        $this->addSql('ALTER TABLE objet DROP premier_item_id, DROP second_item_id');
    }
}
