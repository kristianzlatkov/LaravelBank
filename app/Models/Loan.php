<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loans';

    protected $fillable = [
        'borrower_name',
        'initial_amount',
        'amount_left',
        'term_months',
        'interest_rate',
        'monthly_payment',
    ];

    /**
     * Relation for the payments.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'loan_id');
    }

    /**
     * Get the formatted ID with leading zeros.
     *
     * @return string
     */
    public function getFormattedIdAttribute()
    {
        return str_pad($this->id, 7, '0', STR_PAD_LEFT);
    }

    /**
     * Deduct amount when payment is made.
     *
     * @param $paymentAmount
     * @return void
     */
    public function deductPaymentAmount($paymentAmount): void
    {
        $this->amount_left -= $paymentAmount;
        $this->save();
    }
}
