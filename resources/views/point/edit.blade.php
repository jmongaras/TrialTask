@extends('common.layout')
<meta name="csrf-token" content="{{ csrf_token() }}" />


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Point</h2>
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
  
    <form action="{{ route('points.update',$point->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $point->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                   <strong>X:</strong>
                   <input type="text" name="x" onchange="changePoint(event)" class="form-control" placeholder="X" value="{{ $point->x }}">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                   <strong>Y:</strong>
                   <input type="text" name="y" onchange="changePoint(event)" class="form-control" placeholder="Y" value="{{ $point->y }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary" style="float: left">Submit</button>
              <a class="btn btn-danger" href="{{ route('points.index') }}"> Reset</a>
            </div>
        </div>
    </form>
    <h4> <b>Farthest Point Distance: <span class="farthest-point-distance"> </span></b> </h4>
    <table class="table table-bordered" id="tr-farthest">
        <tr>
            <th>Name</th>
            <th>X</th>
            <th>Y</th>
        </tr>
       
    </table>
    
    <h4> <b> Nearest Point Distance: <span class="nearer-point-distance"> </span></b> </h4>
    <table class="table table-bordered" id="tr-smallest">
        <tr>
            <th>Name</th>
            <th>X</th>
            <th>Y</th>
        </tr>
        
    </table>

@endsection
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>
<script type="text/javascript">

      function changePoint(e)
   {
        e.preventDefault();
        let token = "{{ csrf_token() }}";
        let name = $("input[name=name]").val();
        let x = $("input[name=x]").val();
        let y = $("input[name=y]").val();
        let data = { name:name, x:x, y:y, _token:token};
        $.ajax({
           type:'POST',
           url:`/point-process`,
           data: data,
           success:function(data){
              let response = data;
              console.log("response", response);
              let farthestPoint = response.farthestPoint;
              let nearerPoint = response.nearerPoint;
              let farthestPointHTML = "";
              $('.row-point').remove();
              $.each(farthestPoint, function(index, value ){
                $('.farthest-point-distance').text(value.distance) 
                farthestPointHTML += `<tr class="row-point">
                    <td>${value.name}</td> 
                    <td>${value.x}</td>
                    <td>${value.y}</td>
                </tr>`;
              });

              let nearerPointHTML = ""; 
              $.each(nearerPoint, function( index, value ){
                $('.nearer-point-distance').text(value.distance) 
               nearerPointHTML += `<tr class="row-point"> 
                    <td>${value.name}</td> 
                    <td>${value.x}</td>
                    <td>${value.y}</td>
                </tr>`;
              });
                console.log(farthestPointHTML);
                console.log(nearerPointHTML);
              $('#tr-farthest').append(farthestPointHTML);
              $('#tr-smallest').append(nearerPointHTML);
           }
        });
   }
    </script>