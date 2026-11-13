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
 * Descritivo: Modelo responsável pelas operações de banco de dados de categorias.
 */

declare(strict_types=1);

final class Category
{
    public function __construct(private PDO $db) {}

    public function all(): array
    {
        $sql = 'SELECT c.id, c.name, c.description, c.created_at,
                       COUNT(p.id) AS products_count
                FROM categories c
                LEFT JOIN products p ON p.category_id = c.id
                GROUP BY c.id, c.name, c.description, c.created_at
                ORDER BY c.name';
        return $this->db->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(string $name, string $description): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO categories (name, description) VALUES (:name, :description)'
        );
        $stmt->execute(['name' => $name, 'description' => $description]);
    }

    public function update(int $id, string $name, string $description): void
    {
        $stmt = $this->db->prepare(
            'UPDATE categories SET name = :name, description = :description WHERE id = :id'
        );
        $stmt->execute(['id' => $id, 'name' => $name, 'description' => $description]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM products WHERE category_id = :id');
        $stmt->execute(['id' => $id]);

        if ((int) $stmt->fetchColumn() > 0) {
            return false;
        }

        $stmt = $this->db->prepare('DELETE FROM categories WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
