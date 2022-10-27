<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221015074511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE famille (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE graine (id INT AUTO_INCREMENT NOT NULL, nom_famille_id INT NOT NULL, nom VARCHAR(255) NOT NULL, periode_plantation DATE NOT NULL, periode_recolte DATE NOT NULL, conseils LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, quantite INT NOT NULL, INDEX IDX_251B9ED996E8FBF3 (nom_famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE graine ADD CONSTRAINT FK_251B9ED996E8FBF3 FOREIGN KEY (nom_famille_id) REFERENCES famille (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE graine DROP FOREIGN KEY FK_251B9ED996E8FBF3');
        $this->addSql('DROP TABLE famille');
        $this->addSql('DROP TABLE graine');
    }
}
