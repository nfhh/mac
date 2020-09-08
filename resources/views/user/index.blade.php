@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('common._left')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">用户列表
                        <a class="btn btn-primary" href="{{ route('user.create') }}">
                            添加用户
                        </a>
                    </div>
                    <div class="card-body">
                        @include('common._message')
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">用户名</th>
                                <th scope="col">时间</th>
                                <th scope="col">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->name }}</th>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if($user->id!=1)
                                                <a class="btn btn-primary" href="{{ route('useredit',$user->id) }}">
                                                    编辑
                                                </a>
                                                <a class="btn btn-danger" href="javascript:;"
                                                   onclick="del({{ $user->id }})">
                                                    删除
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function del(id) {
            if (confirm(`确定删除id为 ${id} 的记录吗？`)) {
                var url = '{{ route("user.destroy", ":id") }}';
                url = url.replace(':id', id);
                axios.delete(url).then(function (res) {
                    if (res.data.code === 0) {
                        alert(res.data.message);
                        location.reload();
                    } else {
                        alert(res.data.message);
                    }
                }).catch(function (err) {
                    console.log(err);
                })
            }
        }
    </script>
@endsection
