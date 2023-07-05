<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230705073723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_unit ADD events_id INT DEFAULT NULL, ADD units_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_unit ADD CONSTRAINT FK_C37040F89D6A1065 FOREIGN KEY (events_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_unit ADD CONSTRAINT FK_C37040F899387CE8 FOREIGN KEY (units_id) REFERENCES unit (id)');
        $this->addSql('CREATE INDEX IDX_C37040F89D6A1065 ON event_unit (events_id)');
        $this->addSql('CREATE INDEX IDX_C37040F899387CE8 ON event_unit (units_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_unit DROP FOREIGN KEY FK_C37040F89D6A1065');
        $this->addSql('ALTER TABLE event_unit DROP FOREIGN KEY FK_C37040F899387CE8');
        $this->addSql('DROP INDEX IDX_C37040F89D6A1065 ON event_unit');
        $this->addSql('DROP INDEX IDX_C37040F899387CE8 ON event_unit');
        $this->addSql('ALTER TABLE event_unit DROP events_id, DROP units_id');
    }
}
