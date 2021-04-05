<tr>
    <td>
        <span class="payment-status" data-payment_id="{{ $payment->id }}">{{ $payment->status_name }}</span>
    </td>
    <td>{{ $payment->amount }}</td>
    <td>{{ date('m/d/Y', strtotime($payment->due_date)) }}</td>
    <td>
        <span class="make-paid"
           data-payment_id="{{ $payment->id }}"
           data-url="{{ route('payments.update', ['payment' => $payment]) }}">{{ $payment->is_paid ? '' : 'Mark Paid' }}
        </span>
    </td>

    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalPayment{{$payment->id}}">
            Edit
        </button>
        @include('Project.modals.edit_payment', ['id'=>$payment->id, 'amount' => $payment->amount, 'status' => $payment->status_name, 'status_id' => $payment->status_id,  'date' => date('m/d/Y', strtotime($payment->due_date))])
    </td>
    <td><a href="payment/del/{{$project->id}}/{{$payment->id}}"><button type="button" class="btn btn-outline-danger">Delete</button></a></td>
</tr>







