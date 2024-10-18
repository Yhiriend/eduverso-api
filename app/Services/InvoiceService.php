<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;

class InvoiceService
{
    protected $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function getAllInvoices()
    {
        return $this->invoiceRepository->all();
    }

    public function createInvoice(array $data)
    {
        return $this->invoiceRepository->create($data);
    }

    public function find($id)
    {
        return $this->invoiceRepository->find($id);
    }

    public function updateInvoice($id, array $data)
    {
        return $this->invoiceRepository->update($id, $data);
    }

    public function deleteInvoice($id)
    {
        return $this->invoiceRepository->delete($id);
    }
}
