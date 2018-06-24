@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('/home') }}" class="btn btn-danger btn-sm">Back to profile</a>
                        <a href="{{ url('/user/crud/create') }}" class="btn btn-success btn-sm" title="Add New User">Add New</a>
                        <center>All Users</center></div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_users as $usr)
                                <tr>
                                    <td>{{$usr->id}}</td>
                                    <td>{{ucfirst($usr->first_name)}}</td>
                                    <td>{{ucfirst($usr->first_name)}}</td>
                                    <td>{{$usr->email}}</td>
                                    <td>{{$usr->phone}}</td>
                                    <td>
                                        <a href="{{ url('/user/crud/' . Auth::user()->id . '/edit') }}"><button type="button" rel="tooltip" data-placement="left" title="Edit Profile" class="btn btn-success btn-xs">Edit</button></a>
                                        {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['user/crud', $usr->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete User',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class=" btn-round pull-right">{!! $all_users->appends(['search' => Request::get('search')])->render() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
