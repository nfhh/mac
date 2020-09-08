@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('common._left')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">称重与SN比对
                        @can('access-admin')
                            <a class="btn btn-danger" href="javascript:;"
                               onclick="if(confirm(`确定清空数据吗？`)){
                               event.preventDefault(); document.getElementById('truncate-form').submit();
                           }">
                                清空数据
                            </a>
                            <form id="truncate-form" action="{{ route('weight.truncate') }}" method="POST"
                                  style="display: none;">
                                @csrf
                                @method('delete')
                            </form>
                        @endcan
                    </div>
                    <div class="card-body">
                        @include('common._message')
                        <livewire:weight/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
