@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('common._left')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">机种列表
                        <a class="btn btn-primary" href="{{ route('product.create') }}">
                            添加
                        </a>
                    </div>
                    <div class="card-body">
                        @include('common._message')
                        <div class="table-responsive pt-3">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">序号</th>
                                    <th scope="col">机种</th>
                                    <th scope="col">预定值</th>
                                    <th scope="col">误差值</th>
                                    <th scope="col">时间</th>
                                    <th scope="col">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->guess_val }} 克</td>
                                        <td>{{ $item->difference_val }} 克</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('product.edit',$item->id)}}"
                                                   class="btn btn-secondary">编辑</a>
                                                <a href="javascript:;"
                                                   onclick="
                                                     if(confirm(`确定删除吗？`)){
                                                         $(this).next('form').submit();
                                                     }"
                                                   class="btn btn-danger">删除</a>
                                                <form
                                                    action="{{ route('product.destroy',$item->id) }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

