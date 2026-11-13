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

## Como executar no XAMPP

1. Instale e abra o XAMPP.
2. Inicie os serviços **Apache** e **MySQL**.
3. Copie a pasta `sistema_produtos_categorias` para `C:\xampp\htdocs\`.
4. Abra `http://localhost/phpmyadmin`.
5. Selecione a opção **Importar** e importe o arquivo `database/schema.sql`.
6. Confira as credenciais em `config/database.php`. No XAMPP padrão, o usuário costuma ser `root` e a senha fica vazia.
7. Acesse no navegador:

   `http://localhost/sistema_produtos_categorias/public/`

8. Cadastre ou utilize as categorias de exemplo e, em seguida, cadastre produtos.

## Execução alternativa pelo servidor embutido do PHP

Na pasta raiz do projeto, execute:

```bash
php -S localhost:8000 -t public
```

Depois acesse `http://localhost:8000`.

## Requisitos e observações

- A extensão PDO MySQL do PHP precisa estar habilitada.
- A exclusão de uma categoria que possua produtos vinculados é bloqueada para preservar a integridade dos dados.
- O sistema utiliza consultas preparadas, escape de saída HTML e token CSRF nos formulários de alteração de dados.
- Para uma instalação com usuário e senha diferentes, ajuste `DB_USER` e `DB_PASS` em `config/database.php`.

## Roteiro rápido para apresentação

1. Mostrar o painel inicial e os totais de categorias e produtos.
2. Cadastrar uma categoria.
3. Editar a categoria.
4. Cadastrar um produto e associá-lo à categoria.
5. Mostrar a listagem de produtos com sua categoria.
6. Editar e excluir um produto.
7. Demonstrar que uma categoria com produtos vinculados não pode ser excluída.
8. Excluir os produtos vinculados e, depois, excluir a categoria.

## Entrega

Publique no GitHub a pasta completa do projeto, incluindo os arquivos PHP, CSS, SQL e este README. Confiram o repositório e a data limite antes do envio. O professor solicitou que somente o representante do grupo envie o link do repositório por e-mail, acompanhado dos nomes e RAs dos integrantes.
