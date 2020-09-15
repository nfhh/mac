@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('common._left')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        添加机种
                    </div>
                    <div class="card-body">
                        <form action="{{ route('product.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">机种</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="guess_val">预定值</label>
                                <input type="text" class="form-control @error('guess_val') is-invalid @enderror" id="guess_val" name="guess_val" required>
                                @error('guess_val')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="difference_val">误差值</label>
                                <input type="text" class="form-control @error('difference_val') is-invalid @enderror" id="difference_val" name="difference_val" required>
                                @error('difference_val')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">确定</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
