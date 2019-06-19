<?php declare(strict_types=1);

namespace AppBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190619115150 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE battle (id INT AUTO_INCREMENT NOT NULL, player_attacker_id INT DEFAULT NULL, player_defender_id INT DEFAULT NULL, winner_id INT DEFAULT NULL, battle_date DATE NOT NULL, INDEX IDX_139917343DCF2376 (player_attacker_id), INDEX IDX_139917341209D2FA (player_defender_id), INDEX IDX_139917345DFCD4B8 (winner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_card (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_route VARCHAR(255) DEFAULT NULL, atq_a INT NOT NULL, atq_b INT NOT NULL, atq_c INT NOT NULL, atq_d INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, sign_date DATE NOT NULL, login VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, es_admin TINYINT(1) NOT NULL, image VARCHAR(255) DEFAULT NULL, credits INT NOT NULL, reputation INT NOT NULL, UNIQUE INDEX UNIQ_2DA17977AA08CB10 (login), UNIQUE INDEX UNIQ_2DA17977A188FE64 (nickname), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deck (id INT AUTO_INCREMENT NOT NULL, deck_owner_id INT DEFAULT NULL, deck_name VARCHAR(255) NOT NULL, INDEX IDX_4FAC3637270BD2DB (deck_owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cardsInDeck (deck_id INT NOT NULL, card_id INT NOT NULL, INDEX IDX_B6F75A2111948DC (deck_id), INDEX IDX_B6F75A24ACC9A20 (card_id), PRIMARY KEY(deck_id, card_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, type_card_id INT DEFAULT NULL, card_owner_id INT DEFAULT NULL, INDEX IDX_161498D362EDF5D5 (type_card_id), INDEX IDX_161498D3C70DAF7A (card_owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE battle ADD CONSTRAINT FK_139917343DCF2376 FOREIGN KEY (player_attacker_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE battle ADD CONSTRAINT FK_139917341209D2FA FOREIGN KEY (player_defender_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE battle ADD CONSTRAINT FK_139917345DFCD4B8 FOREIGN KEY (winner_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE deck ADD CONSTRAINT FK_4FAC3637270BD2DB FOREIGN KEY (deck_owner_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE cardsInDeck ADD CONSTRAINT FK_B6F75A2111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cardsInDeck ADD CONSTRAINT FK_B6F75A24ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D362EDF5D5 FOREIGN KEY (type_card_id) REFERENCES type_card (id)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3C70DAF7A FOREIGN KEY (card_owner_id) REFERENCES User (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D362EDF5D5');
        $this->addSql('ALTER TABLE battle DROP FOREIGN KEY FK_139917343DCF2376');
        $this->addSql('ALTER TABLE battle DROP FOREIGN KEY FK_139917341209D2FA');
        $this->addSql('ALTER TABLE battle DROP FOREIGN KEY FK_139917345DFCD4B8');
        $this->addSql('ALTER TABLE deck DROP FOREIGN KEY FK_4FAC3637270BD2DB');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3C70DAF7A');
        $this->addSql('ALTER TABLE cardsInDeck DROP FOREIGN KEY FK_B6F75A2111948DC');
        $this->addSql('ALTER TABLE cardsInDeck DROP FOREIGN KEY FK_B6F75A24ACC9A20');
        $this->addSql('DROP TABLE battle');
        $this->addSql('DROP TABLE type_card');
        $this->addSql('DROP TABLE User');
        $this->addSql('DROP TABLE deck');
        $this->addSql('DROP TABLE cardsInDeck');
        $this->addSql('DROP TABLE card');
    }
}
