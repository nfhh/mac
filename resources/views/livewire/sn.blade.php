<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">扫描SN
            @can('access-admin')
                <a class="btn btn-danger" href="javascript:;"
                   onclick="if(confirm(`确定清空数据吗？`)){
                               event.preventDefault(); document.getElementById('truncate-form').submit();
                           }">
                    清空数据
                </a>
                <form id="truncate-form" action="{{ route('sn.truncate') }}" method="POST"
                      style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            @endcan
        </div>
        <div class="card-body">
            @include('common._message')
            <div class="form-group row" x-data x-init="$refs.sn.focus()">
                <label for="sn" class="col-md-2 col-form-label">SN</label>
                <div class="col-md-10">
                    <input type="search" class="form-control @error('sn') is-invalid @enderror" id="sn" wire:model="sn"
                           x-ref="sn">
                    @error('sn')
                    <div class="invalid-feedback" role="alert">
                        <h2>{{ $message }}</h2>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-3">
        <div class="col-md-6">
            <div class="form-group row">
                <label for="search" class="col-md-2 col-form-label">SN</label>
                <div class="col-md-10">
                    <input type="search" class="form-control" id="search" placeholder="输入SN搜索" wire:model="search">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">SN校验记录</div>
        <div class="card-body">
            <div class="table-responsive pt-3">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">序号</th>
                        <th scope="col">SN</th>
                        <th scope="col">时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sns as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->sn }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $sns->links() }}
        </div>
    </div>
</div>
