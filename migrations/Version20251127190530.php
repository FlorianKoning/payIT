<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251127190530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE merchant DROP FOREIGN KEY FK_74AB25E19D86650F');
        $this->addSql('DROP INDEX IDX_74AB25E19D86650F ON merchant');
        $this->addSql('ALTER TABLE merchant CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE merchant ADD CONSTRAINT FK_74AB25E1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_74AB25E1A76ED395 ON merchant (user_id)');
        $this->addSql('ALTER TABLE payment_method DROP FOREIGN KEY FK_7B61A1F69D86650F');
        $this->addSql('DROP INDEX IDX_7B61A1F69D86650F ON payment_method');
        $this->addSql('ALTER TABLE payment_method DROP user_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE merchant DROP FOREIGN KEY FK_74AB25E1A76ED395');
        $this->addSql('DROP INDEX IDX_74AB25E1A76ED395 ON merchant');
        $this->addSql('ALTER TABLE merchant CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE merchant ADD CONSTRAINT FK_74AB25E19D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_74AB25E19D86650F ON merchant (user_id_id)');
        $this->addSql('ALTER TABLE payment_method ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment_method ADD CONSTRAINT FK_7B61A1F69D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7B61A1F69D86650F ON payment_method (user_id_id)');
    }
}
