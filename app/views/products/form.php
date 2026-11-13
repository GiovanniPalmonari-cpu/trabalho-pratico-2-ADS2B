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
 * Descritivo: Formulário de inclusão e alteração de produtos.
 */
$isEditing = $product !== null;
?>
<div class="page-heading">
    <div><p class="eyebrow">CATÁLOGO</p><h1><?= $isEditing ? 'Editar produto' : 'Novo produto' ?></h1><p class="muted">Informe os dados do produto.</p></div>
    <a class="btn btn-light" href="index.php?page=products">Voltar</a>
</div>

<?php if (!$categories): ?>
    <div class="alert error">Antes de cadastrar produtos, você precisa <a href="index.php?page=categories&action=create">criar uma categoria</a>.</div>
<?php else: ?>
<form class="form-card" method="post" action="index.php?page=products&action=save">
    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
    <?php if ($isEditing): ?><input type="hidden" name="id" value="<?= (int) $product['id'] ?>"><?php endif; ?>
    <div class="field">
        <label for="name">Nome do produto *</label>
        <input id="name" name="name" type="text" maxlength="150" required value="<?= e($product['name'] ?? '') ?>" placeholder="Ex.: Teclado sem fio">
    </div>
    <div class="field">
        <label for="description">Descrição</label>
        <textarea id="description" name="description" rows="3" placeholder="Detalhes do produto (opcional)"><?= e($product['description'] ?? '') ?></textarea>
    </div>
    <div class="form-grid">
        <div class="field">
            <label for="price">Preço (R$) *</label>
            <input id="price" name="price" type="number" min="0" step="0.01" required value="<?= e(isset($product['price']) ? (string) $product['price'] : '') ?>" placeholder="0,00">
        </div>
        <div class="field">
            <label for="stock">Quantidade em estoque *</label>
            <input id="stock" name="stock" type="number" min="0" step="1" required value="<?= e(isset($product['stock']) ? (string) $product['stock'] : '0') ?>">
        </div>
    </div>
    <div class="field">
        <label for="category_id">Categoria *</label>
        <select id="category_id" name="category_id" required>
            <option value="">Selecione uma categoria</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= (int) $category['id'] ?>" <?= (int) ($product['category_id'] ?? 0) === (int) $category['id'] ? 'selected' : '' ?>><?= e($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-actions">
        <a class="btn btn-light" href="index.php?page=products">Cancelar</a>
        <button class="btn btn-primary" type="submit"><?= $isEditing ? 'Salvar alterações' : 'Cadastrar produto' ?></button>
    </div>
</form>
<?php endif; ?>
