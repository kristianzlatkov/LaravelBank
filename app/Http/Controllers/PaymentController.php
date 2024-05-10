<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService
    ) {
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $payments = $this->paymentService->all();
        return response()->json(['payments' => $payments]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required',
            'loan_id' => 'required',
        ]);

        // Check if payment amount exceeds the amount left on the loan
        $loan = Loan::findOrFail($data['loan_id']);
        if ($data['amount'] > $loan->amount_left) {
            $spareAmount = $data['amount'] - $loan->amount_left;
            $loan->amount_left = 0;
            $loan->save();

            $data['payment_date'] = now();
            $this->paymentService->create($data);

            return response()->json(
                ['error' =>
                    'Payment amount exceeds the amount left on the loan. Returning amount left:' . $spareAmount . '.'
                ],
                422);
        }

        $data['payment_date'] = now();
        $payment = $this->paymentService->create($data);

        $loan->amount_left = $loan->amount_left - $data['amount'];
        $loan->save();

        return redirect()->route('index', $payment->id);
    }
}
