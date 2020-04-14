<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200414213540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function preUp(Schema $schema): void
    {
        $query = $this->connection->prepare('INSERT INTO user (username,password,email) 
                                                       VALUES (\'Anonymous\', \'$2y$12$r9qdXyW8kGuzNqQNHutaE.vBWdc6z6BSu4XYwLn8CgGpVK.xGKhvK\', \'Anonymous@gmail.com\')');
        $query->execute();
        $query = $this->connection->prepare('ALTER TABLE task ADD user_id INT NOT NULL');
        $query->execute();
        $query = $this->connection->prepare('Select id from user where username = \'Anonymous\'');
        $query->execute();
        $id = $query->fetchColumn();
        $query = $this->connection->prepare('update task set user_id = ?');
        $query->execute([$id]);
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25A76ED395 ON task (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25A76ED395');
        $this->addSql('DROP INDEX IDX_527EDB25A76ED395 ON task');
        $this->addSql('ALTER TABLE task DROP user_id');
        $this->addSql('delete from user where username = \'Anonymous\'');



    }
}
