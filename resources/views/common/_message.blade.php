@foreach(['success','danger','info'] as $msg)
    @if(session()->has($msg))
        <div class="alert alert-{{$msg}} mt-3 tip">
            {!! session()->get($msg) !!}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif
@endforeach
