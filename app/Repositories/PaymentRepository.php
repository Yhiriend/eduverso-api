<?php

namespace App\Repositories;

use App\Models\PaymentModel;

class PaymentRepository
{
    public function all()
    {
        return PaymentModel::all();
    }

    public function create(array $data)
    {
        return PaymentModel::create($data);
    }

    public function find($id)
    {
        return PaymentModel::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $payment = $this->find($id);
        $payment->update($data);
        return $payment;
    }

    public function delete($id)
    {
        $payment = $this->find($id);
        return $payment->delete();
    }
}
