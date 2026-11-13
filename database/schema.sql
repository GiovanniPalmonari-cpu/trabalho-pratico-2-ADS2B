-- Curso: Tecnologia em Análise e Desenvolvimento de Sistemas
-- Disciplina: Linguagem e Técnicas de Programação
-- Professor: José Carlos Domingues Flores
-- Turma: ADS2B
-- Componentes:
-- 26002959-2 - Giovanni Palmonari
-- 26015725-2 - Etinosa
-- 26008832-2 - Lucas Tavares Ortega
-- 26002534-2 - Ricardo Henrique
-- 26014646-2 - Filipe Cruz
-- Data: 12 de Novembro de 2026
-- Descritivo: Criação do banco de dados e tabelas do sistema CRUD.

CREATE DATABASE IF NOT EXISTS crud_produtos_categorias
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE crud_produtos_categorias;

CREATE TABLE IF NOT EXISTS categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_categories_name (name)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    category_id INT UNSIGNED NOT NULL,
    stock INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_products_category (category_id),
    CONSTRAINT fk_products_categories
        FOREIGN KEY (category_id) REFERENCES categories(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Dados iniciais opcionais para facilitar o primeiro teste.
INSERT IGNORE INTO categories (name, description) VALUES
('Eletrônicos', 'Produtos eletrônicos e acessórios'),
('Informática', 'Equipamentos e periféricos de informática'),
('Acessórios', 'Acessórios em geral');
