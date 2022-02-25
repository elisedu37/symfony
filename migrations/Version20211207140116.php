<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211207140116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ressource_category (ressource_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_48FDA01BFC6CD52A (ressource_id), INDEX IDX_48FDA01B12469DE2 (category_id), PRIMARY KEY(ressource_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ressource_category ADD CONSTRAINT FK_48FDA01BFC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource_category ADD CONSTRAINT FK_48FDA01B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `group` ADD user_id INT DEFAULT NULL, ADD ressource_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id)');
        $this->addSql('CREATE INDEX IDX_6DC044C5A76ED395 ON `group` (user_id)');
        $this->addSql('CREATE INDEX IDX_6DC044C5FC6CD52A ON `group` (ressource_id)');
        $this->addSql('ALTER TABLE loan ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D039D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_C5D30D039D86650F ON loan (user_id_id)');
        $this->addSql('ALTER TABLE ressource ADD loan_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F4544CE73868F FOREIGN KEY (loan_id) REFERENCES loan (id)');
        $this->addSql('CREATE INDEX IDX_939F4544CE73868F ON ressource (loan_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ressource_category');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5A76ED395');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5FC6CD52A');
        $this->addSql('DROP INDEX IDX_6DC044C5A76ED395 ON `group`');
        $this->addSql('DROP INDEX IDX_6DC044C5FC6CD52A ON `group`');
        $this->addSql('ALTER TABLE `group` DROP user_id, DROP ressource_id');
        $this->addSql('ALTER TABLE loan DROP FOREIGN KEY FK_C5D30D039D86650F');
        $this->addSql('DROP INDEX IDX_C5D30D039D86650F ON loan');
        $this->addSql('ALTER TABLE loan DROP user_id_id');
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F4544CE73868F');
        $this->addSql('DROP INDEX IDX_939F4544CE73868F ON ressource');
        $this->addSql('ALTER TABLE ressource DROP loan_id');
    }
}
