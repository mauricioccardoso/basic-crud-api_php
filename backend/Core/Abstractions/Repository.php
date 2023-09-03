<?php

namespace App\Core\Abstractions;

use App\Core\App;
use PDO;

class Repository
{
    private $db;

    private $model;

    public function __construct($model)
    {
        $this->db = App::$app->db;
        $this->model = $model;
    }

    public function getAll()
    {
        $tableName = $this->model::TABLE_NAME;
        $query = "SELECT * FROM $tableName";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $tableName = $this->model::TABLE_NAME;
        $query = "SELECT * FROM $tableName WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $tableName = $this->model::TABLE_NAME;
        $fields = array_keys($data);
        $values = array_values($data);

        $fieldPlaceholders = implode(', ', $fields);
        $valuePlaceholders = implode(', ', array_fill(0, count($fields), '?'));

        $query = "INSERT INTO $tableName ($fieldPlaceholders) VALUES ($valuePlaceholders)";
        $stmt = $this->db->prepare($query);
        $stmt->execute($values);

        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $tableName = $this->model::TABLE_NAME;
        $updates = [];

        foreach ($data as $field => $value) {
            $updates[] = "$field = ?";
        }

        $updates = implode(', ', $updates);

        $query = "UPDATE $tableName SET $updates WHERE id = ?";
        $stmt = $this->db->prepare($query);

        $values = array_values($data);
        $values[] = $id;

        $stmt->execute($values);
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $tableName = $this->model::TABLE_NAME;
        $query = "DELETE FROM $tableName WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
