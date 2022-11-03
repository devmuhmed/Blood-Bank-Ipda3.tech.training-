@extends('admin.layouts.app')
@inject('model','App\Models\Governorate')
@section('page_title') Governorates @endsection
@section('small_title') list of governorates @endsection
@section('content')
    <section class="content">
            <div class="card">
            <div class="card-body">
                <a href="{{url(route('governorate.create'))}}" class="btn btn-primary"> <i class="fa fa-plus"></i>New Governorate </a>
                @if(count($records))
                    <div class="table-responsive text-center mt-2">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{url(route('governorate.edit',$record->id))}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i>Edit</a>
                                            </div>
                                            <div class="col">
                                                {{Form::open([
                                                    'route' => ['governorate.destroy',$record->id],
                                                    'method' => 'Delete'
                                                ])}}
                                                <button class="btn btn-danger btn-sm" type="submit"> <i class="fa fa-trash"></i> delete</button>
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-danger">
                        No record to show
                    </div>
                @endif
            </div>
            <div class="card-footer">

            </div>
        </div>
    </section>
@endsection

