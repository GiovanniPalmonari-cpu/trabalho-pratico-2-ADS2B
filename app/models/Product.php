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
 * Descritivo: Modelo responsável pelas operações de banco de dados de produtos.
 */

declare(strict_types=1);

final class Product
{
    public function __construct(private PDO $db) {}

    public function all(): array
    {
        $sql = 'SELECT p.*, c.name AS category_name
                FROM products p
                INNER JOIN categories c ON c.id = p.category_id
                ORDER BY p.name';
        return $this->db->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(string $name, string $description, string $price, int $categoryId, int $stock): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO products (name, description, price, category_id, stock)
             VALUES (:name, :description, :price, :category_id, :stock)'
        );
        $stmt->execute([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $categoryId,
            'stock' => $stock,
        ]);
    }

    public function update(int $id, string $name, string $description, string $price, int $categoryId, int $stock): void
    {
        $stmt = $this->db->prepare(
            'UPDATE products
             SET name = :name, description = :description, price = :price,
                 category_id = :category_id, stock = :stock
             WHERE id = :id'
        );
        $stmt->execute([
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $categoryId,
            'stock' => $stock,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
