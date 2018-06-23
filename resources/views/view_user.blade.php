@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{ url('/home') }}" class="btn btn-danger btn-xs">Back to profile</a><center>All Users</center></div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Mobile</th>
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
