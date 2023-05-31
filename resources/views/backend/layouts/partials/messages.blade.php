@if ($errors->any())
    <div class="card-body">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    </div>
@endif
