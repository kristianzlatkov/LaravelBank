<?php

namespace App\Repositories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;

class PaymentRepository implements LoanRepositoryInterface
{
    /**
     * Get all payments.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Payment::all();
    }

    /**
     * Create a new payment.
     *
     * @param array $data
     * @return Payment
     */
    public function create(array $data): Payment
    {
        return Payment::create($data);
    }

    /**
     * Update an existing payment.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(array $data, $id): bool
    {
        $payment = Payment::findOrFail($id);
        return $payment->update($data);
    }

    /**
     * Delete a payment.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id): ?bool
    {
        $payment = Payment::findOrFail($id);
        return $payment->delete();
    }

    /**
     * Find a payment by ID.
     *
     * @param int $id
     * @return Payment|null
     */
    public function find($id): ?Payment
    {
        return Payment::findOrFail($id);
    }
}
