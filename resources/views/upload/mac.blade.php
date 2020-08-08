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
                                <input type="file" class="form-control-file" id="file" name="file" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            </div>
                            <button type="submit" class="btn btn-primary">确定</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Mac记录</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
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
