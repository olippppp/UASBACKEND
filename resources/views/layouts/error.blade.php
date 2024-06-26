@if ($errors->any())
    <div class="alert alert-danger mb-4 mt-3">
        <ul style="margin-bottom: 0px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
