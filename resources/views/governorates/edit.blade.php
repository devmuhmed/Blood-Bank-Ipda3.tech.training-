@extends('admin.layouts.app')
@section('page_title') Edit Governorate @endsection
@section('small_title') Edit Governorate @endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-body">
                @include('partial.validation_errors')
                {{ Form::model($model,['route' => ['governorate.update',$model->id],'method'=> 'PUT']) }}
                @include('governorates.form')
                {{ Form::close() }}
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
@endsection

