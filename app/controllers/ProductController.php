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
 * Descritivo: Controlador das operações de cadastro, edição, listagem e exclusão de produtos.
 */

declare(strict_types=1);

final class ProductController
{
    public function __construct(private Product $products, private Category $categories) {}

    public function index(): void
    {
        $products = $this->products->all();
        require __DIR__ . '/../views/products/index.php';
    }

    public function form(?int $id = null): void
    {
        $product = $id ? $this->products->find($id) : null;

        if ($id !== null && $product === null) {
            setFlash('error', 'Produto não encontrado.');
            redirect('index.php?page=products');
        }

        $categories = $this->categories->all();
        require __DIR__ . '/../views/products/form.php';
    }

    public function save(): void
    {
        verifyCsrf();

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?: null;
        $name = postString('name');
        $description = postString('description');
        $priceInput = str_replace(',', '.', postString('price'));
        $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

        $priceValid = $priceInput !== '' && is_numeric($priceInput) && (float) $priceInput >= 0;
        $category = $categoryId ? $this->categories->find($categoryId) : null;
        $stockValid = $stock !== false && $stock !== null && $stock >= 0;

        if ($name === '' || mb_strlen($name) > 150 || !$priceValid || !$category || !$stockValid) {
            setFlash('error', 'Confira os campos: nome, preço válido, categoria e estoque (zero ou maior).');
            redirect($id ? 'index.php?page=products&action=edit&id=' . $id : 'index.php?page=products&action=create');
        }

        try {
            $price = number_format((float) $priceInput, 2, '.', '');
            if ($id) {
                $this->products->update($id, $name, $description, $price, $categoryId, $stock);
                setFlash('success', 'Produto atualizado com sucesso.');
            } else {
                $this->products->create($name, $description, $price, $categoryId, $stock);
                setFlash('success', 'Produto cadastrado com sucesso.');
            }
        } catch (PDOException $exception) {
            setFlash('error', 'Não foi possível salvar o produto. Verifique os dados informados.');
        }

        redirect('index.php?page=products');
    }

    public function delete(): void
    {
        verifyCsrf();
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if ($id && $this->products->delete($id)) {
            setFlash('success', 'Produto excluído com sucesso.');
        } else {
            setFlash('error', 'Produto inválido ou não encontrado.');
        }

        redirect('index.php?page=products');
    }
}
