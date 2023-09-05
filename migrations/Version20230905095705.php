<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230905095705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE champion ADD description LONGTEXT NOT NULL, DROP illustration');
        $this->addSql('ALTER TABLE composition ADD place_moyenne DOUBLE PRECISION NOT NULL, DROP classement');
        $this->addSql('ALTER TABLE origine ADD description LONGTEXT NOT NULL, ADD place_moyenne DOUBLE PRECISION NOT NULL, DROP illustration');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE champion ADD illustration VARCHAR(255) DEFAULT NULL, DROP description');
        $this->addSql('ALTER TABLE composition ADD classement INT NOT NULL, DROP place_moyenne');
        $this->addSql('ALTER TABLE origine ADD illustration VARCHAR(255) DEFAULT NULL, DROP description, DROP place_moyenne');
    }
}
