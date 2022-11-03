@extends('admin.layouts.app')
@inject('model','App\Models\Governorate')
@section('page_title') Create Governorate @endsection
@section('small_title') Create Governorate @endsection
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-body">
                @include('partial.validation_errors')
                {{ Form::model($model,['route' => 'governorate.store']) }}
                    @include('governorates.form')
                {{ Form::close() }}
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
@endsection

