<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">机身与彩盒SN比对
        @can('access-admin')
            <a class="btn btn-danger" href="javascript:;"
               onclick="if(confirm(`确定清空数据吗？`)){
                               event.preventDefault(); document.getElementById('truncate-form').submit();
                           }">
                清空数据
            </a>
            <form id="truncate-form" action="{{ route('sns.truncate') }}" method="POST"
                  style="display: none;">
                @csrf
                @method('delete')
            </form>
        @endcan
    </div>
    <div class="card-body">
        @include('common._message')
        <form x-data="snsApp()"
              x-init="
                              $refs.js_sn.focus();

                              $watch('jssn', value => {
                                  if(value){
                                    $refs.ch_sn.focus();
                                  }
                              });

                              $watch('chsn', value => {
                                  var flag = true;
                                  if(value !== jssn){
                                    error2 = true;
                                    disabled = false;
                                  } else if(value === jssn){
                                    if(value && jssn){
                                        window.livewire.emit('save', jssn, chsn);
                                    }
                                    $refs.js_sn.focus();
                                    error2 = false;
                                    disabled = true;
                                  }
                              });
">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="js_sn">机身SN</label>
                    <input type="text" id="js_sn" class="form-control"
                           x-bind:class="{ 'is-invalid': error1 }" x-ref="js_sn"
                           x-model.debounce="jssn">
                    <template x-if="error1">
                        <div class="invalid-feedback">
                            彩盒SN与机身SN不同
                        </div>
                    </template>
                    @error('jssn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ch_sn">彩盒SN</label>
                    <input type="text" id="ch_sn" class="form-control"
                           x-bind:class="{ 'is-invalid': error2 }" x-ref="ch_sn"
                           x-model.debounce="chsn">
                    @error('chsn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <template x-if="error2">
                        <div class="invalid-feedback">
                            彩盒SN与机身SN不同
                        </div>
                    </template>
                </div>
            </div>
            <button class="btn btn-primary" type="button" x-bind:disabled="disabled" x-on:click="reset">
                重置
            </button>
        </form>
        <script>
            function snsApp() {
                return {
                    jssn: '',
                    chsn: '',
                    error1: false,
                    error2: false,
                    disabled: true,
                    ok: false,
                    reset() {
                        this.jssn = '';
                        this.chsn = '';
                        this.$refs.js_sn.focus();
                    }
                }
            }
        </script>

        <form class="pt-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="search" class="col-md-2 col-form-label">SN</label>
                        <div class="col-md-10">
                            <input type="search" class="form-control" id="search" placeholder="输入SN搜索"
                                   wire:model="search">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive pt-3">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">序号</th>
                    <th scope="col">机身SN</th>
                    <th scope="col">彩盒SN</th>
                    <th scope="col">时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($snss as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->jssn }}</td>
                        <td>{{ $item->chsn }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $snss->links() }}
    </div>
</div>
@push('scripts')
    <script>
        window.livewire.on('resetFormOk', () => {
            location.reload();
        })

        window.livewire.on('jssnx', () => {
            alert('机身SN重复！');
            location.reload();
        })

        window.livewire.on('chsnx', () => {
            alert('彩盒SN重复！');
            location.reload();
        })
    </script>
@endpush
