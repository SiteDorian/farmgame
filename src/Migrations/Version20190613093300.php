<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190613093300 extends AbstractMigration
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
        $this->addSql('CREATE TABLE deposit (id INT AUTO_INCREMENT NOT NULL, plant_id INT NOT NULL, user_id INT NOT NULL, count INT NOT NULL, INDEX IDX_95DB9D391D935652 (plant_id), INDEX IDX_95DB9D39A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lands (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_93AE9538A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plants (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, price_buy INT NOT NULL, price_sell INT NOT NULL, img VARCHAR(255) DEFAULT NULL, time INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', money INT NOT NULL, water INT NOT NULL, UNIQUE INDEX UNIQ_1483A5E992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1483A5E9A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_1483A5E9C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cells ADD CONSTRAINT FK_55C1CBD81994904A FOREIGN KEY (land_id) REFERENCES lands (id)');
        $this->addSql('ALTER TABLE cells ADD CONSTRAINT FK_55C1CBD81D935652 FOREIGN KEY (plant_id) REFERENCES plants (id)');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D391D935652 FOREIGN KEY (plant_id) REFERENCES plants (id)');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D39A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE lands ADD CONSTRAINT FK_93AE9538A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cells DROP FOREIGN KEY FK_55C1CBD81994904A');
        $this->addSql('ALTER TABLE cells DROP FOREIGN KEY FK_55C1CBD81D935652');
        $this->addSql('ALTER TABLE deposit DROP FOREIGN KEY FK_95DB9D391D935652');
        $this->addSql('ALTER TABLE deposit DROP FOREIGN KEY FK_95DB9D39A76ED395');
        $this->addSql('ALTER TABLE lands DROP FOREIGN KEY FK_93AE9538A76ED395');
        $this->addSql('DROP TABLE cells');
        $this->addSql('DROP TABLE deposit');
        $this->addSql('DROP TABLE lands');
        $this->addSql('DROP TABLE plants');
        $this->addSql('DROP TABLE users');
    }
}
