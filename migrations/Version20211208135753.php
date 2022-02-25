<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208135753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE group_ressource (group_id INT NOT NULL, ressource_id INT NOT NULL, INDEX IDX_532C19A5FE54D947 (group_id), INDEX IDX_532C19A5FC6CD52A (ressource_id), PRIMARY KEY(group_id, ressource_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource_category (ressource_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_48FDA01BFC6CD52A (ressource_id), INDEX IDX_48FDA01B12469DE2 (category_id), PRIMARY KEY(ressource_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE group_ressource ADD CONSTRAINT FK_532C19A5FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_ressource ADD CONSTRAINT FK_532C19A5FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource_category ADD CONSTRAINT FK_48FDA01BFC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource_category ADD CONSTRAINT FK_48FDA01B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE group_ressource');
        $this->addSql('DROP TABLE ressource_category');
    }
}
