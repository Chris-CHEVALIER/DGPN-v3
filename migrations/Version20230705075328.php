<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230705075328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_unit DROP FOREIGN KEY FK_C37040F899387CE8');
        $this->addSql('ALTER TABLE event_unit DROP FOREIGN KEY FK_C37040F89D6A1065');
        $this->addSql('DROP INDEX IDX_C37040F89D6A1065 ON event_unit');
        $this->addSql('DROP INDEX IDX_C37040F899387CE8 ON event_unit');
        $this->addSql('ALTER TABLE event_unit ADD event_id INT DEFAULT NULL, ADD unit_id INT DEFAULT NULL, DROP events_id, DROP units_id');
        $this->addSql('ALTER TABLE event_unit ADD CONSTRAINT FK_C37040F871F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_unit ADD CONSTRAINT FK_C37040F8F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('CREATE INDEX IDX_C37040F871F7E88B ON event_unit (event_id)');
        $this->addSql('CREATE INDEX IDX_C37040F8F8BD700D ON event_unit (unit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_unit DROP FOREIGN KEY FK_C37040F871F7E88B');
        $this->addSql('ALTER TABLE event_unit DROP FOREIGN KEY FK_C37040F8F8BD700D');
        $this->addSql('DROP INDEX IDX_C37040F871F7E88B ON event_unit');
        $this->addSql('DROP INDEX IDX_C37040F8F8BD700D ON event_unit');
        $this->addSql('ALTER TABLE event_unit ADD events_id INT DEFAULT NULL, ADD units_id INT DEFAULT NULL, DROP event_id, DROP unit_id');
        $this->addSql('ALTER TABLE event_unit ADD CONSTRAINT FK_C37040F899387CE8 FOREIGN KEY (units_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE event_unit ADD CONSTRAINT FK_C37040F89D6A1065 FOREIGN KEY (events_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_C37040F89D6A1065 ON event_unit (events_id)');
        $this->addSql('CREATE INDEX IDX_C37040F899387CE8 ON event_unit (units_id)');
    }
}
