<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250117123543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE survivant DROP blueskill1_id, DROP blueskill2_id, DROP yellowskill_id, DROP orangeskill1_id, DROP orangeskill2_id, DROP redskill1_id, DROP redskill2_id, DROP redskill3_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE survivant ADD blueskill1_id INT NOT NULL, ADD blueskill2_id INT NOT NULL, ADD yellowskill_id INT NOT NULL, ADD orangeskill1_id INT NOT NULL, ADD orangeskill2_id INT NOT NULL, ADD redskill1_id INT NOT NULL, ADD redskill2_id INT NOT NULL, ADD redskill3_id INT NOT NULL');
    }
}
