<?php

namespace Gabsdsousa\ExpenseTrackr\Controllers;

use Gabsdsousa\ExpenseTrackr\Models\Transaction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends AbstractController
{
    // Fetch all transactions
    public function index(Request $request): Response
    {
        // Here you'd normally fetch data from the model
        $transactions = Transaction::getAll();

        // Return a JSON response with 200 OK status
        return $this->successResponse('Transactions fetched successfully', $transactions);
    }

    // Fetch a single transaction by ID
    public function show(Request $request, int $id): Response
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            return $this->successResponse('Transaction fetched successfully', $transaction);
        }

        return $this->errorResponse('Transaction not found');
    }

    // Create a new transaction
    public function store(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['amount'])) {
            return $this->errorResponse('Amount is required');
        }

        // Assuming the Transaction model takes care of saving
        $transaction = Transaction::create($data);

        return $this->successResponse('Transaction created successfully', ['transaction' => $transaction]);
    }

    // Update an existing transaction
    public function update(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);
        $transaction = Transaction::find($id);

        if ($transaction) {
            $transaction->update($data);

            return $this->successResponse('Transaction updated successfully', ['transaction' => $transaction]);
        }

        return $this->errorResponse('Transaction not found');
    }

    // Delete a transaction
    public function destroy(Request $request, int $id): Response
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            $transaction->delete();

            return $this->successResponse('Transaction deleted successfully');
        }

        return $this->errorResponse('Transaction not found');
    }
}
