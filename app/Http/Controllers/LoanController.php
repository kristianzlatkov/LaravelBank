<?php

namespace App\Http\Controllers;

use App\Services\LoanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct(
        protected LoanService $loanService
    ) {
    }

    public function index(): JsonResponse
    {
        $loans = $this->loanService->all();
        return response()->json(['loans' => $loans]);
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'borrower_name' => 'required|string',
            'initial_amount' => 'required',
            'term_months' => 'required'
        ]);

        if ($this->getSumOfAllCustomerLoans($data['borrower_name']) + $data['initial_amount']  > 80000) {
            return response()->json(
                ['error' => "Customer's loans will exceed the allowed 80000. Loan denied." ],
                422
            );
        }

        $interestRate = $data['interest_rate'] ?? 7.9;
        $data['monthly_payment'] = $this->calculateMonthlyPayment($data['initial_amount'], $data['term_months'], $interestRate);
        $data['amount_left'] = $data['initial_amount'];
        $loan = $this->loanService->create($data);

        return redirect()->route('index', $loan->id);
    }

    private function calculateMonthlyPayment(float $amount, int $termMonths, float $annualInterestRate): float
    {
        // Convert the annual interest rate to a monthly interest rate
        $monthlyInterestRate = ($annualInterestRate / 100) / 12;

        // Calculate the compound interest using a regular interest formula
        $compoundInterest = $amount * (($monthlyInterestRate * (1 + $monthlyInterestRate) ** $termMonths) / ((1 + $monthlyInterestRate) ** $termMonths - 1));

        // Round to 2 decimal places
        return round($compoundInterest, 2);
    }

    private function getSumOfAllCustomerLoans($name) {
        $amountOfAllLoansForCustomer =
            $this->loanService->all()->where('borrower_name', $name)->pluck('initial_amount');
        return $amountOfAllLoansForCustomer->sum(function ($item) {
            return (float) $item;
        });
    }
}
