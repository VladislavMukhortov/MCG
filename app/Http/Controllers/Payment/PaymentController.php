<?php

namespace App\Http\Controllers\Payment;

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

        return $this->success(['status' => $payment->status_name, 'status_id' => $payment->status_id]);
    }
}
