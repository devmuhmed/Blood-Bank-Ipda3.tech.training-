@extends('admin.layouts.app')
@inject('model','App\Models\Governorate')
@section('page_title') Create City @endsection
@section('small_title') Create City @endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-body">
                @include('partial.validation_errors')
                {{ Form::model($model,['route' => 'city.store']) }}
                @include('cities.form')
                {{ Form::close() }}
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
@endsection

