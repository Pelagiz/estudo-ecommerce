<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220611211026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compra (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, produto_id INT NOT NULL, data_efetuada DATE NOT NULL, data_finalizada DATE DEFAULT NULL, total VARCHAR(255) DEFAULT NULL, INDEX IDX_9EC131FFA76ED395 (user_id), INDEX IDX_9EC131FF105CFD56 (produto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE endereco (id INT AUTO_INCREMENT NOT NULL, rua VARCHAR(255) NOT NULL, bairro VARCHAR(255) NOT NULL, cidade VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fornecedor (id INT AUTO_INCREMENT NOT NULL, endereco_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, cnpj VARCHAR(255) NOT NULL, descricao LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_10B663A01BB76823 (endereco_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto (id INT AUTO_INCREMENT NOT NULL, categoria_id INT NOT NULL, nome VARCHAR(255) NOT NULL, quantidade VARCHAR(255) NOT NULL, preco_unitario VARCHAR(255) NOT NULL, descricao LONGTEXT DEFAULT NULL, product_image LONGBLOB DEFAULT NULL, INDEX IDX_5CAC49D73397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, endereco_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, cel VARCHAR(14) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6491BB76823 (endereco_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE venda (id INT AUTO_INCREMENT NOT NULL, fornecedor_id INT NOT NULL, produto_id INT NOT NULL, data_efetuada DATE NOT NULL, data_finalizada DATE DEFAULT NULL, INDEX IDX_C525FC04D3EBB69D (fornecedor_id), INDEX IDX_C525FC04105CFD56 (produto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compra ADD CONSTRAINT FK_9EC131FFA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE compra ADD CONSTRAINT FK_9EC131FF105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id)');
        $this->addSql('ALTER TABLE fornecedor ADD CONSTRAINT FK_10B663A01BB76823 FOREIGN KEY (endereco_id) REFERENCES endereco (id)');
        $this->addSql('ALTER TABLE produto ADD CONSTRAINT FK_5CAC49D73397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6491BB76823 FOREIGN KEY (endereco_id) REFERENCES endereco (id)');
        $this->addSql('ALTER TABLE venda ADD CONSTRAINT FK_C525FC04D3EBB69D FOREIGN KEY (fornecedor_id) REFERENCES fornecedor (id)');
        $this->addSql('ALTER TABLE venda ADD CONSTRAINT FK_C525FC04105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produto DROP FOREIGN KEY FK_5CAC49D73397707A');
        $this->addSql('ALTER TABLE fornecedor DROP FOREIGN KEY FK_10B663A01BB76823');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6491BB76823');
        $this->addSql('ALTER TABLE venda DROP FOREIGN KEY FK_C525FC04D3EBB69D');
        $this->addSql('ALTER TABLE compra DROP FOREIGN KEY FK_9EC131FF105CFD56');
        $this->addSql('ALTER TABLE venda DROP FOREIGN KEY FK_C525FC04105CFD56');
        $this->addSql('ALTER TABLE compra DROP FOREIGN KEY FK_9EC131FFA76ED395');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE compra');
        $this->addSql('DROP TABLE endereco');
        $this->addSql('DROP TABLE fornecedor');
        $this->addSql('DROP TABLE produto');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE venda');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
