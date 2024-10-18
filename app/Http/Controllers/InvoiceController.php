<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\InvoiceService;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index()
    {
        $invoices = $this->invoiceService->getAllInvoices();
        if ($invoices->isEmpty()) {
            return response()->json([
                'message' => 'No invoices found',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'invoices' => $invoices
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|exists:payments,id',
            'total_amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $invoice = $this->invoiceService->createInvoice($request->all());

        return response()->json([
            'message' => 'Invoice created successfully',
            'invoice' => $invoice,
            'status' => 201,
        ], 201);
    }

    public function show($id)
    {
        $invoice = $this->invoiceService->find($id);
        if (!$invoice) {
            return response()->json([
                'message' => 'Invoice not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'invoice' => $invoice
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'total_amount' => 'sometimes|required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $invoice = $this->invoiceService->updateInvoice($id, $request->all());
        if (!$invoice) {
            return response()->json([
                'message' => 'Invoice not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Invoice updated successfully',
            'invoice' => $invoice,
            'status' => 200,
        ], 200);
    }

    public function destroy($id)
    {
        if ($this->invoiceService->deleteInvoice($id)) {
            return response()->json([
                'message' => 'Invoice deleted successfully',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Invoice not found',
            'status' => 404,
        ], 404);
    }
}
