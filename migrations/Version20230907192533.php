<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907192533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objet_item DROP FOREIGN KEY FK_3DF9AC57126F525E');
        $this->addSql('ALTER TABLE objet_item DROP FOREIGN KEY FK_3DF9AC57F520CF5A');
        $this->addSql('DROP TABLE objet_item');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE objet_item (objet_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_3DF9AC57F520CF5A (objet_id), INDEX IDX_3DF9AC57126F525E (item_id), PRIMARY KEY(objet_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE objet_item ADD CONSTRAINT FK_3DF9AC57126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objet_item ADD CONSTRAINT FK_3DF9AC57F520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
