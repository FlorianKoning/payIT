<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251128145038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE api_token DROP FOREIGN KEY FK_7BA2F5EB9D86650F');
        $this->addSql('DROP INDEX IDX_7BA2F5EB9D86650F ON api_token');
        $this->addSql('ALTER TABLE api_token CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE api_token ADD CONSTRAINT FK_7BA2F5EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_7BA2F5EBA76ED395 ON api_token (user_id)');
        $this->addSql('DROP INDEX UNIQ_74AB25E1B5B48B91 ON merchant');
        $this->addSql('ALTER TABLE merchant DROP public_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE api_token DROP FOREIGN KEY FK_7BA2F5EBA76ED395');
        $this->addSql('DROP INDEX IDX_7BA2F5EBA76ED395 ON api_token');
        $this->addSql('ALTER TABLE api_token CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE api_token ADD CONSTRAINT FK_7BA2F5EB9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7BA2F5EB9D86650F ON api_token (user_id_id)');
        $this->addSql('ALTER TABLE merchant ADD public_id VARCHAR(36) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_74AB25E1B5B48B91 ON merchant (public_id)');
    }
}
