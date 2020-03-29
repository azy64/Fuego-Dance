<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200301175536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts ADD user_id INT DEFAULT NULL, ADD type_post_id INT NOT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES students (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA63A86CD9 FOREIGN KEY (type_post_id) REFERENCES type_post (id)');
        $this->addSql('CREATE INDEX IDX_885DBAFAA76ED395 ON posts (user_id)');
        $this->addSql('CREATE INDEX IDX_885DBAFA63A86CD9 ON posts (type_post_id)');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2D5E258C5');
        $this->addSql('DROP INDEX IDX_A4698DB2D5E258C5 ON students');
        $this->addSql('ALTER TABLE students ADD role_id INT NOT NULL, DROP posts_id');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('CREATE INDEX IDX_A4698DB2D60322AC ON students (role_id)');
        $this->addSql('ALTER TABLE type_post DROP FOREIGN KEY FK_8D85A985D5E258C5');
        $this->addSql('DROP INDEX IDX_8D85A985D5E258C5 ON type_post');
        $this->addSql('ALTER TABLE type_post DROP posts_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA63A86CD9');
        $this->addSql('DROP INDEX IDX_885DBAFAA76ED395 ON posts');
        $this->addSql('DROP INDEX IDX_885DBAFA63A86CD9 ON posts');
        $this->addSql('ALTER TABLE posts DROP user_id, DROP type_post_id');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2D60322AC');
        $this->addSql('DROP INDEX IDX_A4698DB2D60322AC ON students');
        $this->addSql('ALTER TABLE students ADD posts_id INT DEFAULT NULL, DROP role_id');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2D5E258C5 FOREIGN KEY (posts_id) REFERENCES posts (id)');
        $this->addSql('CREATE INDEX IDX_A4698DB2D5E258C5 ON students (posts_id)');
        $this->addSql('ALTER TABLE type_post ADD posts_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_post ADD CONSTRAINT FK_8D85A985D5E258C5 FOREIGN KEY (posts_id) REFERENCES posts (id)');
        $this->addSql('CREATE INDEX IDX_8D85A985D5E258C5 ON type_post (posts_id)');
    }
}
