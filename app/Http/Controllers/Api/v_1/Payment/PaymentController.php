<?php

namespace App\Http\Controllers\Api\v_1\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentUpdateRequest;
use App\Http\Traits\Responseable;
use App\Models\Payment;
use App\Repositories\PaymentRepositoryEloquent;

class PaymentController extends Controller
{
    use Responseable;

    protected $repository;

    public function __construct(PaymentRepositoryEloquent $paymentRepository)
    {
        $this->repository = $paymentRepository;
    }

    public function update(Payment $payment, PaymentUpdateRequest $request)
    {
        $this->repository->update($request->validated(), $payment->id);
        $payment->refresh();

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.payments.update.success'),
            ],
        ], 200);
    }
}
