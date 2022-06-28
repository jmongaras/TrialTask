@extends('common.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Point</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('points.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('points.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-8 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <strong>X:</strong>
                <input type="text" name="x" class="form-control" placeholder="X">
            </div>
        </div>
         <div class="col-xs-6">
            <div class="form-group">
                <strong>Y:</strong>
                <input type="text" name="y" class="form-control" placeholder="Y">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary" style="float: left">Submit</button>
        </div>
    </div>
   
</form>
@endsection