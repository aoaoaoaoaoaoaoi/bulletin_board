@extends('layouts.app')

@section('content')

<!-- グループを新しく作成するためのページ -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">グループを作成する</div>

                    <div class="card-body">
                        <form method="POST" action="./make_group_complete">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">イメージ</label>
                                <div class="col-md-6 originalFileBtn"><img src="{{ $resource }}" id="icon-image" onClick="$('#icon-file').click()">
                                <input class="no-back" type="file" name="icon-file" id="icon-file" accept="image/*" style="display:none;"></div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">グループ名</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">グループ説明</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        登録
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

            </div>
        </div>
    </div>
</div>

@endsection