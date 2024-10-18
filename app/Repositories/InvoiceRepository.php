<?php

namespace App\Repositories;

use App\Models\InvoiceModel;

class InvoiceRepository
{
    public function all()
    {
        return InvoiceModel::all();
    }

    public function create(array $data)
    {
        return InvoiceModel::create($data);
    }

    public function find($id)
    {
        return InvoiceModel::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $invoice = $this->find($id);
        $invoice->update($data);
        return $invoice;
    }

    public function delete($id)
    {
        $invoice = $this->find($id);
        return $invoice->delete();
    }
}
