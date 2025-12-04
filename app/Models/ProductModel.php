<?php

namespace App\Models;

use App\Models\Model;
use Exception;
use PDOException;

class ProductModel extends Model
{
    protected $table = 'products'; 

    public function getAllProducts()
    {
        $query = "SELECT id, judul, deskripsi, image_url, produk_url, produk_type, features 
                     FROM products 
                     ORDER BY id DESC";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getProductById($id): ?array 
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->productQuery($sql, $id);
    }
    
    public function getProductsByType(string $productType): ?array
    {
        $sql = "SELECT * FROM {$this->table} 
                 WHERE produk_type @> jsonb_build_array(?)
                 ORDER BY id DESC";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$productType]);
            $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($products as &$product) {
                $product = $this->decodeProductJson($product);
            }

            return $products;
        } catch (\PDOException $e) {
            return null;
        }
    }

    private function productQuery(string $sql, $value): ?array
    {
        try {
            $stmt = $this->db->prepare($sql);
            
            $id = filter_var($value, FILTER_VALIDATE_INT) ? (int)$value : 0;

            if ($id === 0) {
                return null; 
            }
            
            $stmt->execute([$id]); 
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }

        if ($product) {
            return $this->decodeProductJson($product);
        }

        return null;
    }
    
    private function decodeProductJson(array $product): array
    {
        if (isset($product['produk_type']) && is_string($product['produk_type'])) {
            $product['produk_type'] = json_decode($product['produk_type'] ?? '[]', true);
        }
        if (isset($product['features']) && is_string($product['features'])) {
            $product['features'] = json_decode($product['features'] ?? '[]', true);
        }
        
        return $product;
    }

    private function prepareData(array $data): array
    {
        $prepared = [];
        $allowedKeys = ['judul', 'deskripsi', 'produk_url', 'image_url', 'produk_type', 'features'];

        foreach ($allowedKeys as $key) {
            if (array_key_exists($key, $data)) {
                $value = $data[$key];
                
                if ($key === 'produk_type' || $key === 'features') {
                    if (is_array($value)) {
                        $prepared[$key] = json_encode($value); 
                    } else {
                        $prepared[$key] = $value; 
                    }
                } 
                else {
                    $prepared[$key] = $value;
                }
            }
        }
        
        if (!array_key_exists('produk_type', $prepared)) {
            $prepared['produk_type'] = '[]';
        }
        if (!array_key_exists('features', $prepared)) {
            $prepared['features'] = '[]';
        }

        return $prepared;
    }
    
    public function createProduct(array $data)
    {
        $query = "INSERT INTO products (
                      judul, deskripsi, produk_url, image_url, 
                      produk_type, features
                    ) VALUES (
                      :judul, :deskripsi, :produk_url, :image_url, 
                      :produk_type, :features
                    )"; 
        
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':judul', $data['judul']);
            $stmt->bindParam(':deskripsi', $data['deskripsi']);
            $stmt->bindParam(':produk_url', $data['produk_url']);
            $stmt->bindParam(':image_url', $data['image_url']);
            $stmt->bindParam(':produk_type', $data['produk_type']);
            $stmt->bindParam(':features', $data['features']);
            
            return $stmt->execute();

        } catch (PDOException $e) {
            // Melempar PDOException (bukan Exception umum)
            return false;
        }
    }

    public function updateProduct(int $id, array $data): bool
    {
        $preparedData = $this->prepareData($data);

        if (empty($preparedData) && $id > 0) {
            return true; 
        }

        $setParts = [];
        foreach (array_keys($preparedData) as $key) {
            $setParts[] = "{$key} = ?";
        }
        $setClause = implode(', ', $setParts);

        $sql = "UPDATE {$this->table} SET {$setClause} WHERE id = ?";

        $values = array_values($preparedData);
        $values[] = $id;

        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($values);
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deleteProduct(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            return false;
        }
    }
}