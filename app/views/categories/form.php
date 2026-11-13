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
 * Descritivo: Formulário de inclusão e alteração de categorias.
 */
$isEditing = $category !== null;
?>
<div class="page-heading">
    <div><p class="eyebrow">CADASTROS</p><h1><?= $isEditing ? 'Editar categoria' : 'Nova categoria' ?></h1><p class="muted">Preencha os dados abaixo.</p></div>
    <a class="btn btn-light" href="index.php?page=categories">Voltar</a>
</div>

<form class="form-card" method="post" action="index.php?page=categories&action=save">
    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
    <?php if ($isEditing): ?><input type="hidden" name="id" value="<?= (int) $category['id'] ?>"><?php endif; ?>
    <div class="field">
        <label for="name">Nome da categoria *</label>
        <input id="name" name="name" type="text" maxlength="100" required value="<?= e($category['name'] ?? '') ?>" placeholder="Ex.: Eletrônicos">
    </div>
    <div class="field">
        <label for="description">Descrição</label>
        <textarea id="description" name="description" rows="4" placeholder="Descreva esta categoria (opcional)"><?= e($category['description'] ?? '') ?></textarea>
    </div>
    <div class="form-actions">
        <a class="btn btn-light" href="index.php?page=categories">Cancelar</a>
        <button class="btn btn-primary" type="submit"><?= $isEditing ? 'Salvar alterações' : 'Cadastrar categoria' ?></button>
    </div>
</form>
