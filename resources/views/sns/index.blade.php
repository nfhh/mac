@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('common._left')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">机身与彩盒SN比对</div>
                    <div class="card-body">
                        <form x-data="snsApp()"
                              x-init="
                              $refs.js_sn.focus();

                              $watch('jssn', value => {
                                  if(value){
                                    $refs.ch_sn.focus();
                                  }
                              });

                              $watch('chsn', value => {
                                  if(value !== jssn){
                                    error2 = true;
                                    disabled = false;
                                  } else {
                                    jssn = '';
                                    chsn = '';
                                    $refs.js_sn.focus();
                                    error2 = false;
                                    disabled = true;
                                  }
                              });
">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="js_sn">机身SN</label>
                                    <input type="text" id="js_sn"  class="form-control" x-bind:class="{ 'is-invalid': error1 }" x-ref="js_sn" x-model.debounce="jssn">
                                    <template x-if="error1">
                                        <div class="invalid-feedback">
                                            彩盒SN与机身SN不同
                                        </div>
                                    </template>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ch_sn">彩盒SN</label>
                                    <input type="text" id="ch_sn" class="form-control" x-bind:class="{ 'is-invalid': error2 }" x-ref="ch_sn" x-model.debounce="chsn">
                                    <template x-if="error2">
                                        <div class="invalid-feedback">
                                            彩盒SN与机身SN不同
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="button" x-bind:disabled="disabled" x-on:click="reset">重置</button>
                        </form>
                        <script>
                            function snsApp() {
                                return {
                                    jssn: '',
                                    chsn: '',
                                    error1: false,
                                    error2: false,
                                    disabled: true,
                                    reset() {
                                        this.jssn = '';
                                        this.chsn = '';
                                        this.$refs.js_sn.focus();
                                    }
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
