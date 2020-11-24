<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124150050 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE group_tag_tag (group_tag_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_8457798D6954BBC1 (group_tag_id), INDEX IDX_8457798DBAD26311 (tag_id), PRIMARY KEY(group_tag_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE group_tag_tag ADD CONSTRAINT FK_8457798D6954BBC1 FOREIGN KEY (group_tag_id) REFERENCES group_tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_tag_tag ADD CONSTRAINT FK_8457798DBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tag_group_tag');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tag_group_tag (tag_id INT NOT NULL, group_tag_id INT NOT NULL, INDEX IDX_912C65DD6954BBC1 (group_tag_id), INDEX IDX_912C65DDBAD26311 (tag_id), PRIMARY KEY(tag_id, group_tag_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tag_group_tag ADD CONSTRAINT FK_912C65DD6954BBC1 FOREIGN KEY (group_tag_id) REFERENCES group_tag (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_group_tag ADD CONSTRAINT FK_912C65DDBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE group_tag_tag');
    }
}
