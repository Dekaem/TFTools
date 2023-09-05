<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230905070700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actualite (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(100) NOT NULL, texte LONGTEXT NOT NULL, illustration VARCHAR(255) NOT NULL, date_publication DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE champion (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, cout INT NOT NULL, illustration VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE champion_origine (champion_id INT NOT NULL, origine_id INT NOT NULL, INDEX IDX_96778BC2FA7FD7EB (champion_id), INDEX IDX_96778BC287998E (origine_id), PRIMARY KEY(champion_id, origine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE champion_composition (champion_id INT NOT NULL, composition_id INT NOT NULL, INDEX IDX_68F6103CFA7FD7EB (champion_id), INDEX IDX_68F6103C87A2E12 (composition_id), PRIMARY KEY(champion_id, composition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composition (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, classement INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE origine (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, illustration VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE champion_origine ADD CONSTRAINT FK_96778BC2FA7FD7EB FOREIGN KEY (champion_id) REFERENCES champion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE champion_origine ADD CONSTRAINT FK_96778BC287998E FOREIGN KEY (origine_id) REFERENCES origine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE champion_composition ADD CONSTRAINT FK_68F6103CFA7FD7EB FOREIGN KEY (champion_id) REFERENCES champion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE champion_composition ADD CONSTRAINT FK_68F6103C87A2E12 FOREIGN KEY (composition_id) REFERENCES composition (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE champion_origine DROP FOREIGN KEY FK_96778BC2FA7FD7EB');
        $this->addSql('ALTER TABLE champion_origine DROP FOREIGN KEY FK_96778BC287998E');
        $this->addSql('ALTER TABLE champion_composition DROP FOREIGN KEY FK_68F6103CFA7FD7EB');
        $this->addSql('ALTER TABLE champion_composition DROP FOREIGN KEY FK_68F6103C87A2E12');
        $this->addSql('DROP TABLE actualite');
        $this->addSql('DROP TABLE champion');
        $this->addSql('DROP TABLE champion_origine');
        $this->addSql('DROP TABLE champion_composition');
        $this->addSql('DROP TABLE composition');
        $this->addSql('DROP TABLE origine');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
