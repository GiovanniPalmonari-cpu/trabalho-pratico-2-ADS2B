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
 * Descritivo: Listagem de categorias cadastradas.
 */
?>
<div class="page-heading">
    <div><p class="eyebrow">CADASTROS</p><h1>Categorias</h1><p class="muted">Organize os produtos por grupos.</p></div>
    <a class="btn btn-primary" href="index.php?page=categories&action=create">+ Nova categoria</a>
</div>

<div class="table-card">
    <?php if (!$categories): ?>
        <div class="empty-state"><h2>Nenhuma categoria cadastrada</h2><p>Crie a primeira categoria para começar.</p></div>
    <?php else: ?>
        <div class="table-scroll">
            <table>
                <thead><tr><th>Nome</th><th>Descrição</th><th>Produtos</th><th class="actions-col">Ações</th></tr></thead>
                <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td class="primary-cell"><?= e($category['name']) ?></td>
                        <td><?= e($category['description'] ?: '—') ?></td>
                        <td><span class="count-pill"><?= (int) $category['products_count'] ?></span></td>
                        <td class="actions">
                            <a class="btn btn-small btn-light" href="index.php?page=categories&action=edit&id=<?= (int) $category['id'] ?>">Editar</a>
                            <form method="post" action="index.php?page=categories&action=delete" onsubmit="return confirm('Deseja realmente excluir esta categoria?');">
                                <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                                <input type="hidden" name="id" value="<?= (int) $category['id'] ?>">
                                <button class="btn btn-small btn-danger" type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
