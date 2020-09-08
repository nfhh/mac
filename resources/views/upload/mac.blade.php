@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('common._left')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">上传Mac表</div>
                    <div class="card-body">
                        @include('common._message')
                        <form action="{{ route('upload.mac') }}" method="post" enctype="multipart/form-data">
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

                <form class="pt-3" action="{{ route('upload.mac') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="mac" class="col-md-2 col-form-label">mac</label>
                                <div class="col-md-10">
                                    <input type="search" class="form-control" id="mac" name="mac" value="{{ request('mac') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group">
                                <button class="btn btn-primary" type="submit">搜索</button>
                                <a class="btn btn-secondary" href="{{ route('upload.snkey') }}">重置</a>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">SN&密钥记录
                        <a class="btn btn-danger" href="javascript:;"
                           onclick="if(confirm(`确定清空数据吗？`)){
                               event.preventDefault(); document.getElementById('truncate-form').submit();
                           }">
                            清空数据
                        </a>
                        <form id="truncate-form" action="{{ route('mac.truncate') }}" method="POST"
                              style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">序号</th>
                                <th scope="col">MAC</th>
                                <th scope="col">导入时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($macs as $mac)
                                <tr>
                                    <th scope="row">{{ $mac->id }}</th>
                                    <td>{{ $mac->mac }}</td>
                                    <td>{{ $mac->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $macs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
