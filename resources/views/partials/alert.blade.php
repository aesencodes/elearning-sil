@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mg-t-20 mt-3" role="alert">
        {!! session('success') !!}
    </div>
@elseif(session('danger'))
    <div class="alert alert-danger alert-dismissible fade show mg-t-20 mt-3" role="alert">
        {!! session('danger') !!}
    </div>
@endif
