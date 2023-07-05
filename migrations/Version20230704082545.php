<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230704082545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD event_unit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA77DEAD9A2 FOREIGN KEY (event_unit_id) REFERENCES event_unit (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA77DEAD9A2 ON event (event_unit_id)');
        $this->addSql('ALTER TABLE event_unit DROP FOREIGN KEY FK_C37040F871F7E88B');
        $this->addSql('DROP INDEX IDX_C37040F871F7E88B ON event_unit');
        $this->addSql('ALTER TABLE event_unit DROP event_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA77DEAD9A2');
        $this->addSql('DROP INDEX IDX_3BAE0AA77DEAD9A2 ON event');
        $this->addSql('ALTER TABLE event DROP event_unit_id');
        $this->addSql('ALTER TABLE event_unit ADD event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_unit ADD CONSTRAINT FK_C37040F871F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_C37040F871F7E88B ON event_unit (event_id)');
    }
}
