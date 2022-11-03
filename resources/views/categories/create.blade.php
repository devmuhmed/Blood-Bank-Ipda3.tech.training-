@extends('admin.layouts.app')
@inject('model','App\Models\Category')
@section('page_title') Create Category @endsection
@section('small_title') Create Category @endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-body">
                @include('partial.validation_errors')
                {{ Form::model($model,['route' => 'category.store']) }}
                @include('categories.form')
                {{ Form::close() }}
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
@endsection

