<?php

namespace Gabsdsousa\ExpenseTrackr\Models;

use PDO;
use PDOException;

class Transaction
{
    // Properties corresponding to the transaction table columns
    public $id;
    public $description;
    public $amount;
    public $category;
    public $created_at;
    public $updated_at;

    // Hold the PDO connection
    protected static $pdo;

    // Constructor to initialize the model properties
    public function __construct($description = null, $amount = null, $category = null)
    {
        $this->description = $description;
        $this->amount = $amount;
        $this->category = $category;
    }

    // Method to set the PDO connection
    public static function setConnection(PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    // Establishing a connection to the database
    protected static function getDbConnection()
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO('mysql:host=mariadb;dbname=expense_tracker', 'local', 'password');
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    // Fetch all transactions
    public static function getAll()
    {
        $pdo = self::getDbConnection();
        $stmt = $pdo->query('SELECT * FROM transactions ORDER BY created_at DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Find a specific transaction by ID
    public static function find($id)
    {
        $pdo = self::getDbConnection();
        $stmt = $pdo->prepare('SELECT * FROM transactions WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new transaction
    public function save(): self
    {
        $pdo = self::getDbConnection();

        if ($this->id) {
            // If ID is set, perform an update
            $stmt = $pdo->prepare('UPDATE transactions SET description = :description, amount = :amount, category = :category, updated_at = date() WHERE id = :id');
            $stmt->execute([
                'description' => $this->description,
                'amount'      => $this->amount,
                'category'    => $this->category,
                'id'          => $this->id,
            ]);
        } else {
            // Otherwise, insert a new record
            $stmt = $pdo->prepare('INSERT INTO transactions (description, amount, category, created_at, updated_at) VALUES (:description, :amount, :category, date(), date())');
            $stmt->execute([
                'description' => $this->description,
                'amount'      => $this->amount,
                'category'    => $this->category,
            ]);

            // Set the last inserted ID to the model's ID property
            $this->id = $pdo->lastInsertId();
        }

        return $this;
    }

    public static function create($data): self
    {
        $new = new self(...$data);
        $new->save();

        return $new;
    }

    public function update($data): self
    {
        $this->description = $data['description'] ?? $this->description;
        $this->amount = $data['amount'] ?? $this->amount;
        $this->category = $data['category'] ?? $this->category;
        $this->save();

        return $this;
    }

    // Delete a transaction by ID
    public static function delete($id)
    {
        $pdo = self::getDbConnection();
        $stmt = $pdo->prepare('DELETE FROM transactions WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
