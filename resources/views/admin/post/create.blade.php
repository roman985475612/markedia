@extends('admin.layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Новая категория</h3>
          </div>
          <form action="{{ route('categories.store') }}" method="POST" role="form">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="title">Наименование</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Наименование категории">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@endsection