<?php

use Gabsdsousa\ExpenseTrackr\Models\Transaction;

beforeEach(function () {
    // Set up an in-memory SQLite database connection for testing
    $pdo = new PDO('sqlite::memory:');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the transactions table in the SQLite database
    // Create the transactions table in the SQLite database
    $pdo->exec("
        CREATE TABLE transactions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            description TEXT NOT NULL,
            amount REAL NOT NULL,
            category TEXT,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Bind the in-memory PDO instance to the Transaction model
    Transaction::setConnection($pdo);
});

it('can create a transaction', function () {
    $transaction = new Transaction('Test Description', 123.45, 'Test Category');
    $transaction->save();

    // Check if the transaction was saved correctly
    $savedTransaction = Transaction::find($transaction->id);
    expect($savedTransaction)->not->toBeNull();
    expect($savedTransaction['description'])->toBe('Test Description');
    expect($savedTransaction['amount'])->toBe(123.45);
    expect($savedTransaction['category'])->toBe('Test Category');
});

it('can retrieve all transactions', function () {
    // Create two sample transactions
    $transaction1 = new Transaction('Description 1', 50.00, 'Category 1');
    $transaction1->save();

    $transaction2 = new Transaction('Description 2', 150.00, 'Category 2');
    $transaction2->save();

    // Retrieve all transactions
    $transactions = Transaction::getAll();

    expect($transactions)->toBeArray();
    expect(count($transactions))->toBe(2);
    expect($transactions[0]['description'])->toBe('Description 1');
    expect($transactions[1]['description'])->toBe('Description 2');
});

it('can update a transaction', function () {
    $transaction = new Transaction('Original Description', 200.00, 'Original Category');
    $transaction->save();

    // Update the transaction
    $transaction->description = 'Updated Description';
    $transaction->amount = 300.00;
    $transaction->save();

    // Fetch the updated transaction
    $updatedTransaction = Transaction::find($transaction->id);

    expect($updatedTransaction['description'])->toBe('Updated Description');
    expect($updatedTransaction['amount'])->toBe(300.00);
});

it('can delete a transaction', function () {
    $transaction = new Transaction('To be deleted', 100.00, 'Category');
    $transaction->save();

    // Delete the transaction
    Transaction::delete($transaction->id);

    // Ensure the transaction no longer exists
    $deletedTransaction = Transaction::find($transaction->id);
    expect($deletedTransaction)->toBeFalse(); // Expect false because the transaction should be deleted
});
