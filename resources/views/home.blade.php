@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('upload.mac') }}" class="list-group-item list-group-item-action active">
                        上传MAC表
                    </a>
                    <a href="{{ route('upload.snkey') }}" class="list-group-item list-group-item-action">上传SN&密钥表</a>
                    <a href="{{ route('upload.pcba') }}" class="list-group-item list-group-item-action">上传PCBA结果表</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
