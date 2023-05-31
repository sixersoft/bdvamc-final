@if ($errors->any())
    <div class="card-body">
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    </div>
@endif


@if (Session::has('success'))
    <div class="alert alert-success">
        <div>
            {{ Session::get('success') }}
        </div>
    </div>
@endif
