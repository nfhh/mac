<div>
    <div class="form-group row" x-data x-init="$refs.sn.focus()">
        <label for="sn" class="col-sm-2 col-form-label">sn</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('sn') is-invalid @enderror" id="sn" wire:model="sn"
                   x-ref="sn">
            @error('sn')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
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
