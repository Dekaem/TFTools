<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230905125225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE champion_objet (champion_id INT NOT NULL, objet_id INT NOT NULL, INDEX IDX_F4BC1791FA7FD7EB (champion_id), INDEX IDX_F4BC1791F520CF5A (objet_id), PRIMARY KEY(champion_id, objet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE legende (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, specialite VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objet (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, embleme TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objet_item (objet_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_3DF9AC57F520CF5A (objet_id), INDEX IDX_3DF9AC57126F525E (item_id), PRIMARY KEY(objet_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE palier (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE palier_origine (id INT AUTO_INCREMENT NOT NULL, palier_id INT NOT NULL, origine_id INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_38AEC7160E28355 (palier_id), INDEX IDX_38AEC7187998E (origine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, riot_linked TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE champion_objet ADD CONSTRAINT FK_F4BC1791FA7FD7EB FOREIGN KEY (champion_id) REFERENCES champion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE champion_objet ADD CONSTRAINT FK_F4BC1791F520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objet_item ADD CONSTRAINT FK_3DF9AC57F520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objet_item ADD CONSTRAINT FK_3DF9AC57126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE palier_origine ADD CONSTRAINT FK_38AEC7160E28355 FOREIGN KEY (palier_id) REFERENCES palier (id)');
        $this->addSql('ALTER TABLE palier_origine ADD CONSTRAINT FK_38AEC7187998E FOREIGN KEY (origine_id) REFERENCES origine (id)');
        $this->addSql('ALTER TABLE composition ADD legende_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F4347F6B12637 FOREIGN KEY (legende_id) REFERENCES legende (id)');
        $this->addSql('CREATE INDEX IDX_C7F4347F6B12637 ON composition (legende_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE composition DROP FOREIGN KEY FK_C7F4347F6B12637');
        $this->addSql('ALTER TABLE champion_objet DROP FOREIGN KEY FK_F4BC1791FA7FD7EB');
        $this->addSql('ALTER TABLE champion_objet DROP FOREIGN KEY FK_F4BC1791F520CF5A');
        $this->addSql('ALTER TABLE objet_item DROP FOREIGN KEY FK_3DF9AC57F520CF5A');
        $this->addSql('ALTER TABLE objet_item DROP FOREIGN KEY FK_3DF9AC57126F525E');
        $this->addSql('ALTER TABLE palier_origine DROP FOREIGN KEY FK_38AEC7160E28355');
        $this->addSql('ALTER TABLE palier_origine DROP FOREIGN KEY FK_38AEC7187998E');
        $this->addSql('DROP TABLE champion_objet');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE legende');
        $this->addSql('DROP TABLE objet');
        $this->addSql('DROP TABLE objet_item');
        $this->addSql('DROP TABLE palier');
        $this->addSql('DROP TABLE palier_origine');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_C7F4347F6B12637 ON composition');
        $this->addSql('ALTER TABLE composition DROP legende_id');
    }
}
