<?php

namespace App\Services;

use App\Repositories\LoanRepositoryInterface;

class LoanService
{
    public function __construct(
        protected LoanRepositoryInterface $loanRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->loanRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->loanRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->loanRepository->delete($id);
    }

    public function all()
    {
        return $this->loanRepository->all();
    }

    public function find($id)
    {
        return $this->loanRepository->find($id);
    }
}
