
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Point</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?php echo e(route('points.index')); ?>"> Back</a>
            </div>
        </div>
    </div>
   
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
  
    <form action="<?php echo e(route('points.update',$point->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="<?php echo e($point->name); ?>" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                   <strong>X:</strong>
                   <input type="text" name="x" onchange="changePoint(event)" class="form-control" placeholder="X" value="<?php echo e($point->x); ?>">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                   <strong>Y:</strong>
                   <input type="text" name="y" onchange="changePoint(event)" class="form-control" placeholder="Y" value="<?php echo e($point->y); ?>">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary" style="float: left">Submit</button>
              <a class="btn btn-danger" href="<?php echo e(route('points.index')); ?>"> Reset</a>
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

<?php $__env->stopSection(); ?>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>
<script type="text/javascript">

      function changePoint(e)
   {
        e.preventDefault();
        let token = "<?php echo e(csrf_token()); ?>";
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
<?php echo $__env->make('common.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wampp\www\TrialTask\resources\views/point/edit.blade.php ENDPATH**/ ?>