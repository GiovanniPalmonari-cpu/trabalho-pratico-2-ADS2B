# Sistema de Gerenciamento de Produtos e Categorias

Projeto acadêmico da disciplina **Linguagem e Técnicas de Programação**, curso de Tecnologia em Análise e Desenvolvimento de Sistemas, turma ADS2B.

## Integrantes

- Giovanni Palmonari — RA 26002959-2
- Etinosa — RA 26015725-2
- Lucas Tavares Ortega — RA 26008832-2
- Ricardo Henrique — RA 26002534-2
- Filipe Cruz — RA 26014646-2

## Tecnologias

- PHP 8.1 ou superior
- MySQL 5.7+ ou MariaDB compatível
- HTML5 e CSS3
- PDO para acesso ao banco de dados

## Funcionalidades

### Categorias
- Cadastrar categoria.
- Listar categorias.
- Editar categoria.
- Excluir categoria quando não houver produtos vinculados.
- Visualizar a quantidade de produtos de cada categoria.

### Produtos
- Cadastrar produto com nome, descrição, preço, estoque e categoria.
- Listar produtos com o nome da categoria.
- Editar produto.
- Excluir produto.

## Estrutura do projeto

```text
sistema_produtos_categorias/
├── app/
│   ├── controllers/
│   │   ├── CategoryController.php
│   │   └── ProductController.php
│   ├── models/
│   │   ├── Category.php
│   │   └── Product.php
│   ├── views/
│   │   ├── categories/
│   │   ├── products/
│   │   ├── dashboard.php
│   │   └── layout.php
│   └── helpers.php
├── config/
│   └── database.php
├── database/
│   └── schema.sql
├── public/
│   ├── assets/css/style.css
│   └── index.php
└── README.md
```




