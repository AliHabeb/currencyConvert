<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190206114357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, source_id INT NOT NULL, name VARCHAR(255) NOT NULL, rate VARCHAR(255) NOT NULL, INDEX IDX_6956883F953C1C61 (source_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE currency ADD CONSTRAINT FK_6956883F953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
        $this->addSql('INSERT INTO source VALUES (null,"ecb","https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml")');
        $this->addSql('INSERT INTO source VALUES (null,"cbr","https://www.cbr.ru/scripts/XML_daily.asp")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE currency DROP FOREIGN KEY FK_6956883F953C1C61');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE source');
    }
}
