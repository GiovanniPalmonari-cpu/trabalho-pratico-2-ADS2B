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
 * Descritivo: Listagem de produtos com suas respectivas categorias.
 */
?>
<div class="page-heading">
    <div><p class="eyebrow">CATÁLOGO</p><h1>Produtos</h1><p class="muted">Consulte e atualize os produtos cadastrados.</p></div>
    <a class="btn btn-primary" href="index.php?page=products&action=create">+ Novo produto</a>
</div>

<div class="table-card">
    <?php if (!$products): ?>
        <div class="empty-state"><h2>Nenhum produto cadastrado</h2><p>Cadastre uma categoria e depois adicione seu primeiro produto.</p></div>
    <?php else: ?>
        <div class="table-scroll">
            <table>
                <thead><tr><th>Produto</th><th>Categoria</th><th>Preço</th><th>Estoque</th><th class="actions-col">Ações</th></tr></thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><span class="primary-cell"><?= e($product['name']) ?></span><small class="sub-cell"><?= e($product['description'] ?: '') ?></small></td>
                        <td><?= e($product['category_name']) ?></td>
                        <td class="price-cell">R$ <?= number_format((float) $product['price'], 2, ',', '.') ?></td>
                        <td><span class="count-pill"><?= (int) $product['stock'] ?></span></td>
                        <td class="actions">
                            <a class="btn btn-small btn-light" href="index.php?page=products&action=edit&id=<?= (int) $product['id'] ?>">Editar</a>
                            <form method="post" action="index.php?page=products&action=delete" onsubmit="return confirm('Deseja realmente excluir este produto?');">
                                <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                                <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
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
