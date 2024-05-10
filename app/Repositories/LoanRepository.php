<?php

namespace App\Repositories;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Collection;

class LoanRepository implements LoanRepositoryInterface
{
    /**
     * Get all loans.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Loan::all();
    }

    /**
     * Create a new loan.
     *
     * @param array $data
     * @return Loan
     */
    public function create(array $data): Loan
    {
        return Loan::create($data);
    }

    /**
     * Update an existing loan.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(array $data, $id): bool
    {
        $loan = Loan::findOrFail($id);
        return $loan->update($data);
    }

    /**
     * Delete a loan.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id): ?bool
    {
        $loan = Loan::findOrFail($id);
        return $loan->delete();
    }

    /**
     * Find a loan by ID.
     *
     * @param int $id
     * @return Loan|null
     */
    public function find($id): ?Loan
    {
        return Loan::findOrFail($id);
    }
}
