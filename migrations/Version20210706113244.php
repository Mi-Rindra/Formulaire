<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706113244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE codepostal (id INT AUTO_INCREMENT NOT NULL, libelle INT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dirigeant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe (id INT AUTO_INCREMENT NOT NULL, codepostal_id INT DEFAULT NULL, ville_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_19653DBDC9B1D722 (codepostal_id), INDEX IDX_19653DBDA73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe_typesociete (societe_id INT NOT NULL, typesociete_id INT NOT NULL, INDEX IDX_A32E66F7FCF77503 (societe_id), INDEX IDX_A32E66F75AD950E (typesociete_id), PRIMARY KEY(societe_id, typesociete_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typesociete (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, codepostal_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_43C3D9C3C9B1D722 (codepostal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBDC9B1D722 FOREIGN KEY (codepostal_id) REFERENCES codepostal (id)');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBDA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE societe_typesociete ADD CONSTRAINT FK_A32E66F7FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE societe_typesociete ADD CONSTRAINT FK_A32E66F75AD950E FOREIGN KEY (typesociete_id) REFERENCES typesociete (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3C9B1D722 FOREIGN KEY (codepostal_id) REFERENCES codepostal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe DROP FOREIGN KEY FK_19653DBDC9B1D722');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3C9B1D722');
        $this->addSql('ALTER TABLE societe_typesociete DROP FOREIGN KEY FK_A32E66F7FCF77503');
        $this->addSql('ALTER TABLE societe_typesociete DROP FOREIGN KEY FK_A32E66F75AD950E');
        $this->addSql('ALTER TABLE societe DROP FOREIGN KEY FK_19653DBDA73F0036');
        $this->addSql('DROP TABLE codepostal');
        $this->addSql('DROP TABLE dirigeant');
        $this->addSql('DROP TABLE societe');
        $this->addSql('DROP TABLE societe_typesociete');
        $this->addSql('DROP TABLE typesociete');
        $this->addSql('DROP TABLE ville');
    }
}
