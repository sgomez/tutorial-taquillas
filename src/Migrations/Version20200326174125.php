<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200326174125 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_1E067DC0D737E9B1');
        $this->addSql('DROP INDEX IDX_1E067DC09F2C3FAB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__locker AS SELECT id, zone_id, lessor_id, code, status FROM locker');
        $this->addSql('DROP TABLE locker');
        $this->addSql('CREATE TABLE locker (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, zone_id INTEGER NOT NULL, lessor_id INTEGER DEFAULT NULL, code VARCHAR(255) NOT NULL COLLATE BINARY, status VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_1E067DC09F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1E067DC0D737E9B1 FOREIGN KEY (lessor_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO locker (id, zone_id, lessor_id, code, status) SELECT id, zone_id, lessor_id, code, status FROM __temp__locker');
        $this->addSql('DROP TABLE __temp__locker');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1E067DC0D737E9B1 ON locker (lessor_id)');
        $this->addSql('CREATE INDEX IDX_1E067DC09F2C3FAB ON locker (zone_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('DROP INDEX IDX_8D93D649680CAB68');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, faculty_id, username, roles, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, faculty_id INTEGER DEFAULT NULL, username VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , password VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_8D93D649680CAB68 FOREIGN KEY (faculty_id) REFERENCES faculty (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, faculty_id, username, roles, password) SELECT id, faculty_id, username, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE INDEX IDX_8D93D649680CAB68 ON user (faculty_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__faculty AS SELECT id, name, slug, is_enabled FROM faculty');
        $this->addSql('DROP TABLE faculty');
        $this->addSql('CREATE TABLE faculty (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, is_enabled BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO faculty (id, name, slug, is_enabled) SELECT id, name, slug, is_enabled FROM __temp__faculty');
        $this->addSql('DROP TABLE __temp__faculty');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_17966043989D9B62 ON faculty (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_17966043989D9B62');
        $this->addSql('CREATE TEMPORARY TABLE __temp__faculty AS SELECT id, name, slug, is_enabled FROM faculty');
        $this->addSql('DROP TABLE faculty');
        $this->addSql('CREATE TABLE faculty (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, is_enabled BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO faculty (id, name, slug, is_enabled) SELECT id, name, slug, is_enabled FROM __temp__faculty');
        $this->addSql('DROP TABLE __temp__faculty');
        $this->addSql('DROP INDEX IDX_1E067DC09F2C3FAB');
        $this->addSql('DROP INDEX UNIQ_1E067DC0D737E9B1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__locker AS SELECT id, zone_id, lessor_id, code, status FROM locker');
        $this->addSql('DROP TABLE locker');
        $this->addSql('CREATE TABLE locker (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, zone_id INTEGER NOT NULL, lessor_id INTEGER DEFAULT NULL, code VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO locker (id, zone_id, lessor_id, code, status) SELECT id, zone_id, lessor_id, code, status FROM __temp__locker');
        $this->addSql('DROP TABLE __temp__locker');
        $this->addSql('CREATE INDEX IDX_1E067DC09F2C3FAB ON locker (zone_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1E067DC0D737E9B1 ON locker (lessor_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('DROP INDEX IDX_8D93D649680CAB68');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, faculty_id, username, roles, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, faculty_id INTEGER DEFAULT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, faculty_id, username, roles, password) SELECT id, faculty_id, username, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE INDEX IDX_8D93D649680CAB68 ON user (faculty_id)');
    }
}
