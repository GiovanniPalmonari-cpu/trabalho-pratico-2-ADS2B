<?php
/**
 * Curso: Tecnologia em Análise e Desenvolvimento de Sistemas
 * Disciplina: Linguagem e Técnicas de Programação
 * Professor: José Carlos Domingues Flores
 * Turma: ADS2B
 * Componentes: Giovanni Palmonari (26002959-2), Etinosa (26015725-2),
 * Lucas Tavares Ortega (26008832-2), Ricardo Henrique (26002534-2),
 * Filipe Cruz (26014646-2)
 * Data: 12 de Novembro de 2026
 * Descritivo: Estrutura visual compartilhada pelas páginas do sistema.
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Produtos e Categorias</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="container nav-wrap">
        <a class="brand" href="index.php">Gestão<span>Fácil</span></a>
        <nav>
            <a href="index.php">Início</a>
            <a href="index.php?page=categories">Categorias</a>
            <a href="index.php?page=products">Produtos</a>
        </nav>
    </div>
</header>

<main class="container main-content">
    <?php if ($flash): ?>
        <div class="alert <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
    <?php endif; ?>
    <?= $content ?>
</main>

<footer class="footer">
    <div class="container">Projeto acadêmico — ADS2B | Linguagem e Técnicas de Programação</div>
</footer>
</body>
</html>
