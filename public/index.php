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
 * Descritivo: Ponto de entrada e roteador principal do sistema CRUD.
 */

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/models/Category.php';
require_once __DIR__ . '/../app/models/Product.php';
require_once __DIR__ . '/../app/controllers/CategoryController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';

try {
    $db = getPDO();
} catch (PDOException $exception) {
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados. Confira o MySQL e as configurações em config/database.php. Detalhe: ' . e($exception->getMessage()));
}

$categoryModel = new Category($db);
$productModel = new Product($db);
$categoryController = new CategoryController($categoryModel);
$productController = new ProductController($productModel, $categoryModel);

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($page === 'categories' && $action === 'save') {
        $categoryController->save();
    } elseif ($page === 'categories' && $action === 'delete') {
        $categoryController->delete();
    } elseif ($page === 'products' && $action === 'save') {
        $productController->save();
    } elseif ($page === 'products' && $action === 'delete') {
        $productController->delete();
    }

    http_response_code(404);
    exit('Ação não encontrada.');
}

ob_start();

if ($page === 'categories') {
    if ($action === 'create') {
        $categoryController->form();
    } elseif ($action === 'edit') {
        $categoryController->form($id);
    } else {
        $categoryController->index();
    }
} elseif ($page === 'products') {
    if ($action === 'create') {
        $productController->form();
    } elseif ($action === 'edit') {
        $productController->form($id);
    } else {
        $productController->index();
    }
} else {
    $categoryCount = (int) $db->query('SELECT COUNT(*) FROM categories')->fetchColumn();
    $productCount = (int) $db->query('SELECT COUNT(*) FROM products')->fetchColumn();
    require __DIR__ . '/../app/views/dashboard.php';
}

$content = ob_get_clean();
$flash = getFlash();
require __DIR__ . '/../app/views/layout.php';
