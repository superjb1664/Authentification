<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322195327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_atelier ADD atelier_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire_atelier ADD CONSTRAINT FK_92738A7082E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('CREATE INDEX IDX_92738A7082E2CF35 ON commentaire_atelier (atelier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_atelier DROP FOREIGN KEY FK_92738A7082E2CF35');
        $this->addSql('DROP INDEX IDX_92738A7082E2CF35 ON commentaire_atelier');
        $this->addSql('ALTER TABLE commentaire_atelier DROP atelier_id');
    }
}
