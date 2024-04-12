<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240412113827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE used_car_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, employee_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, grade SMALLINT NOT NULL, message TEXT NOT NULL, accepted BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C8C03F15C ON comment (employee_id)');
        $this->addSql('CREATE TABLE used_car (id INT NOT NULL, employee_id INT NOT NULL, model VARCHAR(255) DEFAULT NULL, kilometers INT DEFAULT NULL, year INT DEFAULT NULL, price NUMERIC(10, 2) DEFAULT NULL, picture_filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_738BE5348C03F15C ON used_car (employee_id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE used_car ADD CONSTRAINT FK_738BE5348C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE used_car_id_seq CASCADE');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C8C03F15C');
        $this->addSql('ALTER TABLE used_car DROP CONSTRAINT FK_738BE5348C03F15C');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE used_car');
    }
}
