<div class="w-full h-auto p-4">
    <div class="flex justify-between items-center">
        <div>Detail of {{$withdraw->user->username}} Withdraw</div>
        <div class="p-2 cursor-pointer" wire:click.prevent="$emit('closeModal')">
            <i class='bx bx-x text-danger text-2xl'></i>
        </div>
    </div>
    <br/>
    <form method="post" action="{{route('reject-withdraw', $withdraw->id)}}">
        @csrf
        <div class="form-group row">
            <label for="amount" class="col-md-4 col-form-label text-md-right">Reject Reason</label>
            <div class="col-md-6">
                <input class="form-control" name="rejected_comment" required autofocus>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-danger">Reject</button>
            </div>
        </div>
    </form>
</div>
