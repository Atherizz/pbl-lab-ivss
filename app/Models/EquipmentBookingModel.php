<?php

namespace App\Models;

use App\Models\Model; 
use PDO; 

class EquipmentBookingModel extends Model
{
    protected $table = 'equipment_bookings';

    public function getAllEquipmentNameId()
    {
        $query = $this->db->prepare("SELECT id, name FROM {$this->table} ORDER BY name ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBookings()
    {
        $query_sql = "
            SELECT 
                eb.*, 
                e.name AS equipment_name, 
                u.name AS user_name
            FROM 
                {$this->table} eb
            JOIN 
                equipment e ON eb.equipment_id = e.id
            JOIN 
                users u ON eb.user_id = u.id WHERE eb.status = :status
            ORDER BY 
                eb.start_date DESC
        ";
        
        $query = $this->db->prepare($query_sql);
        $query->execute(['status' => 'pending_approval']);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query_sql = "
            SELECT 
                eb.*, 
                e.name AS equipment_name,
                u.name AS user_username
            FROM 
                {$this->table} eb
            JOIN 
                equipment e ON eb.equipment_id = e.id
            JOIN 
                users u ON eb.user_id = u.id
            WHERE 
                eb.id = :id
        ";
        
        $query = $this->db->prepare($query_sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function createBooking(array $data)
    {
        $query_sql = "
            INSERT INTO {$this->table} 
            (equipment_id, user_id, start_date, end_date, notes, status) 
            VALUES (:equipment_id, :user_id, :start_date, :end_date, :notes, 'pending_approval')
        ";

        $query = $this->db->prepare($query_sql);
        $success = $query->execute([
            'equipment_id' => $data['equipment_id'],
            'user_id'      => $data['user_id'],
            'start_date'   => $data['start_date'],
            'end_date'     => $data['end_date'],
            'notes'        => $data['notes']
        ]);
        
        return $success ? $query->rowCount() : 0;
    }

    public function updateBooking($id, array $data)
    {
        $query_sql = "
            UPDATE {$this->table} SET
                equipment_id = :equipment_id,
                start_date = :start_date,
                end_date = :end_date,
                status = :status,
                notes = :notes
            WHERE id = :id
        ";

        $query = $this->db->prepare($query_sql);
        $success = $query->execute([
            'equipment_id' => $data['equipment_id'],
            'start_date'   => $data['start_date'],
            'end_date'     => $data['end_date'],
            'status'       => $data['status'],
            'notes'        => $data['notes'],
            'id'           => $id
        ]);
        
        return $success ? $query->rowCount() : 0;
    }

    public function updateBookingStatus($id, $status)
    {
        $query_sql = "
            UPDATE {$this->table} SET
                status = :status
            WHERE id = :id
        ";
        
        $query = $this->db->prepare($query_sql);
        $success = $query->execute([
            'status' => $status,
            'id'     => $id
        ]);
        
        return $success ? $query->rowCount() : 0;
    }
    
    public function deleteBooking($id)
    {
        $query_sql = "DELETE FROM {$this->table} WHERE id = :id";
        
        $query = $this->db->prepare($query_sql);
        $success = $query->execute(['id' => $id]);
        
        return $success ? $query->rowCount() : 0;
    }
}