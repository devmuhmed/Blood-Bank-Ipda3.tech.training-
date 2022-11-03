@extends('admin.layouts.app')
@section('page_title') Edit Category @endsection
@section('small_title') Edit Category @endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-body">
                @include('partial.validation_errors')
                {{ Form::model($model,['route' => ['category.update',$model->id],'method'=> 'PUT']) }}
                @include('categories.form')
                {{ Form::close() }}
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
@endsection

