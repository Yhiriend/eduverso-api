<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $payments = $this->paymentService->getAllPayments();
        if ($payments->isEmpty()) {
            return response()->json([
                'message' => 'No payments found',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'payments' => $payments
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:user,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $payment = $this->paymentService->createPayment($request->all());

        return response()->json([
            'message' => 'Payment created successfully',
            'payment' => $payment,
            'status' => 201,
        ], 201);
    }

    public function show($id)
    {
        $payment = $this->paymentService->getPayment($id);
        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'payment' => $payment
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'sometimes|required|numeric',
            'payment_method' => 'sometimes|required|string|max:255',
            'payment_status' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $payment = $this->paymentService->updatePayment($id, $request->all());
        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Payment updated successfully',
            'payment' => $payment,
            'status' => 200,
        ], 200);
    }

    public function destroy($id)
    {
        if ($this->paymentService->deletePayment($id)) {
            return response()->json([
                'message' => 'Payment deleted successfully',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Payment not found',
            'status' => 404,
        ], 404);
    }
}
