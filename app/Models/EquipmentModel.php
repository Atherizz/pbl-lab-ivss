<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class EquipmentModel extends Model
{

    public function getAllEquipments()
    {
        $query = $this->db->prepare("SELECT * FROM equipment");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->db->prepare("SELECT * FROM equipment WHERE id = :id");
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function createEquipment($data)
    {
        $query = $this->db->prepare("INSERT INTO equipment (name, description, status) VALUES (:name, :description, :status)");
        return $query->execute(['name' => $data['name'], 'description' => $data['description'], 'status' => $data['status']]);
    }

    public function updateEquipment($id, $data)
    {
        $query = $this->db->prepare("
        UPDATE equipment 
        SET name = :name, description = :description, status = :status
        WHERE id = :id
    ");
        return $query->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'],
            'id' => $id
        ]);
    }

    public function deleteEquipment($id)
    {
        $query = $this->db->prepare("DELETE FROM equipment WHERE id = :id");
        return $query->execute(['id' => $id]);
    }
}
