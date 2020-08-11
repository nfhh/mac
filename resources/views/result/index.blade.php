@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('common._left')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">比对结果</div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <ul class="list-unstyled">
                                <li><span class="bg-primary d-inline-block" style="width: 10px;height: 10px;"></span> 重复</li>
                                <li><span class="bg-danger d-inline-block" style="width: 10px;height: 10px;"></span> 多余</li>
                            </ul>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">SN</th>
                                <th scope="col">密钥</th>
                                <th scope="col">MAC</th>
                                <th scope="col">时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <th scope="row">{{ $result->id }}</th>
                                    <td>{!! $result->sn !!}</td>
                                    <td>{!! $result->key !!}</td>
                                    <td>{!! $result->mac !!}</td>
                                    <td>{{ $result->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $results->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
