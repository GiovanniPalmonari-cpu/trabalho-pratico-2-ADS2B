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
 * Descritivo: Painel inicial com resumo dos registros cadastrados.
 */
?>
<section class="hero">
    <p class="eyebrow">PAINEL DE CONTROLE</p>
    <h1>Organize seus produtos com facilidade.</h1>
    <p>Cadastre categorias, gerencie produtos e mantenha suas informações em um só lugar.</p>
    <div class="hero-actions">
        <a class="btn btn-primary" href="index.php?page=products&action=create">Cadastrar produto</a>
        <a class="btn btn-light" href="index.php?page=categories&action=create">Nova categoria</a>
    </div>
</section>

<section class="stats">
    <article class="stat-card">
        <span class="stat-label">Categorias cadastradas</span>
        <strong><?= (int) $categoryCount ?></strong>
        <a href="index.php?page=categories">Gerenciar categorias →</a>
    </article>
    <article class="stat-card">
        <span class="stat-label">Produtos cadastrados</span>
        <strong><?= (int) $productCount ?></strong>
        <a href="index.php?page=products">Gerenciar produtos →</a>
    </article>
</section>

<section class="welcome-card">
    <h2>Como começar?</h2>
    <ol>
        <li>Cadastre uma ou mais categorias.</li>
        <li>Cadastre os produtos e selecione a categoria correspondente.</li>
        <li>Use as opções de editar e excluir para manter os dados atualizados.</li>
    </ol>
</section>
