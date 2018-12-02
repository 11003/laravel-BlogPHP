@if(session('success'))
    <div class="ui positive message">
        <i class="close icon"></i>
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="ui error message">
        <ul class="list">
            @foreach($errors->all() as $error_msg)
                <li>{{ $error_msg }}</li>
            @endforeach
        </ul>
    </div>
@endif