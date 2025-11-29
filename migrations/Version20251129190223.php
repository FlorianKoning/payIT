<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251129190223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE api_client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token_id INT NOT NULL, name VARCHAR(191) NOT NULL, public_id VARCHAR(191) NOT NULL, INDEX IDX_41B343D5A76ED395 (user_id), INDEX IDX_41B343D541DEE7B9 (token_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE api_client ADD CONSTRAINT FK_41B343D5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE api_client ADD CONSTRAINT FK_41B343D541DEE7B9 FOREIGN KEY (token_id) REFERENCES api_token (id)');
        $this->addSql('ALTER TABLE merchant DROP FOREIGN KEY FK_74AB25E1A76ED395');
        $this->addSql('DROP INDEX IDX_74AB25E1A76ED395 ON merchant');
        $this->addSql('ALTER TABLE merchant DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE api_client DROP FOREIGN KEY FK_41B343D5A76ED395');
        $this->addSql('ALTER TABLE api_client DROP FOREIGN KEY FK_41B343D541DEE7B9');
        $this->addSql('DROP TABLE api_client');
        $this->addSql('ALTER TABLE merchant ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE merchant ADD CONSTRAINT FK_74AB25E1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_74AB25E1A76ED395 ON merchant (user_id)');
    }
}
