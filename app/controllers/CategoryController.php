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
 * Descritivo: Controlador das operações de cadastro, edição, listagem e exclusão de categorias.
 */

declare(strict_types=1);

final class CategoryController
{
    public function __construct(private Category $categories) {}

    public function index(): void
    {
        $categories = $this->categories->all();
        require __DIR__ . '/../views/categories/index.php';
    }

    public function form(?int $id = null): void
    {
        $category = $id ? $this->categories->find($id) : null;

        if ($id !== null && $category === null) {
            setFlash('error', 'Categoria não encontrada.');
            redirect('index.php?page=categories');
        }

        require __DIR__ . '/../views/categories/form.php';
    }

    public function save(): void
    {
        verifyCsrf();

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?: null;
        $name = postString('name');
        $description = postString('description');

        if ($name === '' || mb_strlen($name) > 100) {
            setFlash('error', 'Informe um nome de categoria com até 100 caracteres.');
            redirect($id ? 'index.php?page=categories&action=edit&id=' . $id : 'index.php?page=categories&action=create');
        }

        try {
            if ($id) {
                $this->categories->update($id, $name, $description);
                setFlash('success', 'Categoria atualizada com sucesso.');
            } else {
                $this->categories->create($name, $description);
                setFlash('success', 'Categoria cadastrada com sucesso.');
            }
        } catch (PDOException $exception) {
            setFlash('error', 'Não foi possível salvar. Verifique se já existe uma categoria com esse nome.');
        }

        redirect('index.php?page=categories');
    }

    public function delete(): void
    {
        verifyCsrf();
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            setFlash('error', 'Categoria inválida.');
        } elseif ($this->categories->delete($id)) {
            setFlash('success', 'Categoria excluída com sucesso.');
        } else {
            setFlash('error', 'A categoria possui produtos vinculados ou não existe. Exclua ou transfira os produtos primeiro.');
        }

        redirect('index.php?page=categories');
    }
}
