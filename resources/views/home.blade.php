@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Profile</center></div>
                <div class="panel-body">
                        <div class="fb-profile">
                            @php
                            $profile_img = Auth::user()->profile_picture
                            @endphp
                            <img align="left" class="fb-image-lg" src="{{ URL::asset("UserImage/bg.jpg")}}" alt="Profile BG Image"/>
                            <img align="left" class="fb-image-profile thumbnail" src="{{ URL::asset("UserImage/$profile_img")}}" alt="Profile image"/>
                            <div class="fb-profile-text">
                                <h3>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                                <p class="padding_left">Email :{{ Auth::user()->email }}</p>
                                <p class="padding_left">Mobile :{{ Auth::user()->phone }}</p>
                            </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#uploadModel">Change Profile Image</button>
                    <a href="{{ url('/all_users/' . Auth::user()->id . '/edit') }}"><button type="button" rel="tooltip" data-placement="left" title="Edit Profile" class="btn btn-success btn-xs">Edit Profile</button></a>
                    <a href="{{ url('/all_users') }}" class="btn btn-danger btn-xs">View all user</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModel" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><h4 class="modal-title">Upload Image</h4></center>
            </div>
            {!! Form::open([ 'route' => [ 'ajax.upload' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
            {!! Form::close() !!}
            <div class="modal-footer">
                <center><button class="btn btn-primary" onclick="location.reload()">Ok</button></center>
            </div>
        </div>

    </div>
</div>
    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize   : 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
    </script>
@endsection
