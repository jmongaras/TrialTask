@extends('common.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Trial Task</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('points.create') }}"> Create New Point</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($points as $point)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $point->name }}</td>
            <td>{{ $point->x }}</td>
            <td>{{ $point->y }}</td>
            <td>
                <form action="{{ route('points.destroy',$point->id) }}" method="POST">
   
                    {{-- <a class="btn btn-info" href="{{ route('points.show',$point->id) }}">Show</a> --}}
    
                    <a class="btn btn-primary" href="{{ route('points.edit',$point->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $points->links() !!}
      
@endsection