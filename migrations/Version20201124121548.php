<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124121548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE group_tag (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_group_tag (tag_id INT NOT NULL, group_tag_id INT NOT NULL, INDEX IDX_912C65DDBAD26311 (tag_id), INDEX IDX_912C65DD6954BBC1 (group_tag_id), PRIMARY KEY(tag_id, group_tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_group_tag ADD CONSTRAINT FK_912C65DDBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_group_tag ADD CONSTRAINT FK_912C65DD6954BBC1 FOREIGN KEY (group_tag_id) REFERENCES group_tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tag_group_tag DROP FOREIGN KEY FK_912C65DD6954BBC1');
        $this->addSql('ALTER TABLE tag_group_tag DROP FOREIGN KEY FK_912C65DDBAD26311');
        $this->addSql('DROP TABLE group_tag');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_group_tag');
    }
}
