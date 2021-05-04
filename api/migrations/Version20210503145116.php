<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503145116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auth_users CHANGE id id VARCHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE sport_exercises CHANGE id id VARCHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE sport_results CHANGE id id VARCHAR(36) NOT NULL, CHANGE exercise_id exercise_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sport_results ADD CONSTRAINT FK_3E16A8BEE934951A FOREIGN KEY (exercise_id) REFERENCES sport_exercises (id)');
        $this->addSql('CREATE INDEX IDX_3E16A8BEE934951A ON sport_results (exercise_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auth_users CHANGE id id VARCHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE sport_exercises CHANGE id id VARCHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE sport_results DROP FOREIGN KEY FK_3E16A8BEE934951A');
        $this->addSql('DROP INDEX IDX_3E16A8BEE934951A ON sport_results');
        $this->addSql('ALTER TABLE sport_results CHANGE id id VARCHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE exercise_id exercise_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
