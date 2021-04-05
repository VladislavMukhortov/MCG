<tr>
    <td>{{ date('m/d/Y', strtotime($payout->date)) }}</td>
    <td>{{ $payout->subcontractor_company_name }}</td>
    <td>${{ $payout->amount }}</td>
    <td>{{ $payout->status_name }}</td>

    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalPayout{{$payout->id}}">
                Edit
            </button>

        @include('Project.modals.edit_payout', ['id'=>$payout->id, 'date' => date('m/d/Y', strtotime($payout->date)), 'status' => $payout->status_name, 'status_id' => $payout->status_id, 'amount' => $payout->amount, 'subcontractor_company_name' => $payout->subcontractor_company_name, 'subcon' => $payout->subcontractor_id])
    </td>
    <td><a href="payouts/del/{{$project->id}}/{{$payout->id}}"><button type="button" class="btn btn-outline-danger">Delete</button></a>



    </td>


</tr>


