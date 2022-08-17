@if (session()->has('form.errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach (session()->get('form.errors')->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif (session()->has('form.success'))
    <div class="alert alert-success">
        <ul>
            @foreach (session()->get('form.success')->all() as $success)
                <li>{{ $success }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($errors->has('error_message'))
    <p class="text-danger">{{ $errors->first('error_message') }}</p>
@endif