<?php
/**
 * Curso: Tecnologia em Análise e Desenvolvimento de Sistemas
 * Disciplina: Linguagem e Técnicas de Programação
 * Professor: José Carlos Domingues Flores
 * Turma: ADS2B
 * Componentes:
 *   26002959-2 - Giovanni Palmonari
 *   26015725-2 - Etinosa
 *   26008832-2 - Lucas Tavares Ortega
 *   26002534-2 - Ricardo Henrique
 *   26014646-2 - Filipe Cruz
 * Data: 12 de Novembro de 2026
 * Descritivo: Configuração de conexão com o banco de dados MySQL.
 */

declare(strict_types=1);

const DB_HOST = '127.0.0.1';
const DB_NAME = 'crud_produtos_categorias';
const DB_USER = 'root';
const DB_PASS = ''; // Padrão do XAMPP. Altere se sua instalação usar senha.

function getPDO(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';

    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}
