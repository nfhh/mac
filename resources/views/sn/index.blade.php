@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('common._left')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">SN校验</div>
                    <div class="card-body">
                        <livewire:sn/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
