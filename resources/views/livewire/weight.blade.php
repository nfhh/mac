<div>
    <form x-data x-init="$refs.sn.focus()" x-on:refocus.window="$refs.sn.focus()" wire:submit.prevent="store">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="machine">机种</label>
                <input type="text" class="form-control" id="machine" name="machine" wire:model="machine">
            </div>
            <div class="form-group col-md-6">
                <label for="sn">机身SN</label>
                <input type="text" class="form-control @error('sn') is-invalid @enderror" id="sn" x-ref="sn" wire:model="sn">
                @error('sn')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="guess_val">预定值</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="guess_val" wire:model="guess_val">
                    <div class="input-group-append">
                        <span class="input-group-text">克</span>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="difference_val">误差值</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="difference_val" wire:model="difference_val">
                    <div class="input-group-append">
                        <span class="input-group-text">克</span>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="actual_val">实际值</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="actual_val" readonly wire:model="actual_val">
                    <div class="input-group-append">
                        <span class="input-group-text">克</span>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">确定</button>
    </form>
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
</div>
@push('scripts')
    <script>
        setTimeout(() => {
            window.livewire.emit('getWeight', '19.9');
        }, 300);
    </script>
@endpush
