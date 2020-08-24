@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('common._left')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">上传SN&密钥表</div>
                    <div class="card-body">
                        @include('common._message')
                        <form action="{{ route('upload.snkey') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">上传</label>
                                <input type="file" class="form-control-file" id="file" name="file"
                                       accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            </div>
                            <button type="submit" class="btn btn-primary">确定</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">SN&密钥记录
                        <a class="btn btn-danger" href="javascript:;"
                           onclick="if(confirm(`确定清空数据吗？`)){
                               event.preventDefault(); document.getElementById('truncate-form').submit();
                           }">
                            清空数据
                        </a>
                        <form id="truncate-form" action="{{ route('snkey.truncate') }}" method="POST"
                              style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">SN</th>
                                <th scope="col">密钥</th>
                                <th scope="col">导入时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($snkeys as $snkey)
                                <tr>
                                    <th scope="row">{{ $snkey->id }}</th>
                                    <td>{{ $snkey->sn }}</td>
                                    <td>{{ $snkey->key }}</td>
                                    <td>{{ $snkey->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $snkeys->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
