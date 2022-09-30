<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderTransaction extends Model
{
    use HasFactory;

    const NEW_ORDER = 0;
    const PAYMENT_COMPLETED = 1;
    const UNDER_PROCESS = 2;
    const FINISHED = 3;
    const REJECTED = 4;
    const CANCELLED = 5;
    const REFUND_REQUESTED = 6;
    const RETURNED = 7;
    const REFUNDED = 8;
    protected $guarded = [];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function status($transaction_number = null): string
    {
        $transaction = $transaction_number != '' ? $transaction_number : $this->transaction;
        switch ($transaction) {
            case 0:
                $result = 'New order';
                break;
            case 1:
                $result = 'Paid';
                break;
            case 2:
                $result = 'Under Process';
                break;
            case 3:
                $result = 'Finished';
                break;
            case 4:
                $result = 'Rejected';
                break;
            case 5:
                $result = 'Cancelled';
                break;
            case 6:
                $result = 'Refund requested';
                break;
            case 7:
                $result = 'Returned order';
                break;
            case 8:
                $result = 'Refunded';
                break;
        }
        return $result;
    }
}
