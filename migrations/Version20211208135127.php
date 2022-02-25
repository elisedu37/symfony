<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208135127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE group_ressource (group_id INT NOT NULL, ressource_id INT NOT NULL, INDEX IDX_532C19A5FE54D947 (group_id), INDEX IDX_532C19A5FC6CD52A (ressource_id), PRIMARY KEY(group_id, ressource_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE group_ressource ADD CONSTRAINT FK_532C19A5FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_ressource ADD CONSTRAINT FK_532C19A5FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5FC6CD52A');
        $this->addSql('DROP INDEX IDX_6DC044C5FC6CD52A ON `group`');
        $this->addSql('ALTER TABLE `group` DROP ressource_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE group_ressource');
        $this->addSql('ALTER TABLE `group` ADD ressource_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id)');
        $this->addSql('CREATE INDEX IDX_6DC044C5FC6CD52A ON `group` (ressource_id)');
    }
}
