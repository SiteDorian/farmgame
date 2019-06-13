<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612175449 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cells (id INT AUTO_INCREMENT NOT NULL, land_id INT NOT NULL, plant_id INT DEFAULT NULL, stage INT NOT NULL, time DATETIME NOT NULL, INDEX IDX_55C1CBD81994904A (land_id), INDEX IDX_55C1CBD81D935652 (plant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lands (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plants (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, price_buy INT NOT NULL, price_sell INT NOT NULL, img VARCHAR(255) DEFAULT NULL, time INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cells ADD CONSTRAINT FK_55C1CBD81994904A FOREIGN KEY (land_id) REFERENCES lands (id)');
        $this->addSql('ALTER TABLE cells ADD CONSTRAINT FK_55C1CBD81D935652 FOREIGN KEY (plant_id) REFERENCES plants (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cells DROP FOREIGN KEY FK_55C1CBD81994904A');
        $this->addSql('ALTER TABLE cells DROP FOREIGN KEY FK_55C1CBD81D935652');
        $this->addSql('DROP TABLE cells');
        $this->addSql('DROP TABLE lands');
        $this->addSql('DROP TABLE plants');
    }
}
