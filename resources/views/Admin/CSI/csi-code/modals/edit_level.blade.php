<!-- Modal -->
<div class="modal fade" id="exampleModalLevel{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('csi-edit') }}" method="post">
                    @method('POST')
                    @csrf

                    <div class="form-group">
                        <label>Level name</label>
                        <input type="text" class="form-control" name="name" value="{{$level_name}}" required>

                    </div>
                    <div class="form-group">
                        <label>Level description</label>
                        <input type="text" class="form-control" name="description" value="{{$level_description}}" required>

                    </div>
                    <input type="hidden" name="id" value="{{$id}}">
                    <button type="submit" class="btn btn-primary">Submit</button>


                </form>
            </div>

        </div>
    </div>
</div>