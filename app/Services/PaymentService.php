<?php

namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService
{
    public function __construct(
        protected PaymentRepository $paymentRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->paymentRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->paymentRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->paymentRepository->delete($id);
    }

    public function all()
    {
        return $this->paymentRepository->all();
    }

    public function find($id)
    {
        return $this->paymentRepository->find($id);
    }
}
