@extends('admin.layouts.app')
@section('page_title') Edit City @endsection
@section('small_title') Edit City @endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-body">
                @include('partial.validation_errors')
                {{ Form::model($model,['route' => ['city.update',$model->id],'method'=> 'PUT']) }}
                @include('cities.form')
                {{ Form::close() }}
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
@endsection

