<div>
    <form x-data x-init="$refs.sn.focus()" x-on:refocus.window="$refs.sn.focus()" wire:submit.prevent="handleStore">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="machine">机种</label>
                <select name="machine" id="machine" class="form-control" wire:model="form.machine">
                    @foreach($products as $item)
                        <option value="{{ $item->title }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="guess_val">预定值</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="guess_val" wire:model="form.guess_val" readonly required>
                    <div class="input-group-append">
                        <span class="input-group-text">克</span>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="difference_val">误差值</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="difference_val" wire:model="form.difference_val"
                           readonly required>
                    <div class="input-group-append">
                        <span class="input-group-text">克</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="sn">机身SN</label>
                <input type="text" class="form-control @error('sn') is-invalid @enderror" id="sn" x-ref="sn"
                       wire:model="form.sn" required>
                @error('sn')
                <div class="invalid-feedback">
                    <h2>{{ $message }}</h2>
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="actual_val">实际值</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="actual_val" wire:model="form.actual_val" readonly required>
                    <div class="input-group-append">
                        <span class="input-group-text">克</span>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">确定</button>
    </form>

    <div class="row pt-3">
        <div class="col-md-5">
            <div class="form-group row">
                <label for="search_cn" class="col-md-3 col-form-label">SN</label>
                <div class="col-md-9">
                    <input type="search" class="form-control" id="search_cn" placeholder="输入SN搜索"
                           wire:model="search.sn">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group row">
                <label for="created_at" class="col-md-3 col-form-label">日期</label>
                <div class="col-md-9">
                    <input type="date" class="form-control" id="created_at" wire:model="search.created_at">
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <a href="/weight" class="btn btn-primary">重置</a>
        </div>
    </div>

    <div class="table-responsive pt-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">序号</th>
                <th scope="col">机种</th>
                <th scope="col">机身SN</th>
                <th scope="col">预定值</th>
                <th scope="col">误差值</th>
                <th scope="col">实际值</th>
                <th scope="col">结果</th>
                <th scope="col">时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($weights as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->machine }}</td>
                    <td>{{ $item->sn }}</td>
                    <td>{{ $item->guess_val }} 克</td>
                    <td>{{ $item->difference_val }} 克</td>
                    <td>{{ $item->actual_val }} 克</td>
                    <td>{{ $item->result }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $weights->links() }}

    @if($open)
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">提示</h5>
                        <button type="button" class="close" wire:click="$set('open', false)">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-danger">已存在SN，确定将覆盖！</h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('open', false)">关闭
                        </button>
                        <button type="button" class="btn btn-primary" wire:click="handleUpdate">确定</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

</div>
@push('scripts')
    <script>
        ws = new WebSocket("ws://127.0.0.1:8000");
        ws.onmessage = function (e) {
            console.log(e.data);
            window.livewire.emit('getWeight', parseInt(e.data.split(' ')[2]));
        };
    </script>
@endpush
