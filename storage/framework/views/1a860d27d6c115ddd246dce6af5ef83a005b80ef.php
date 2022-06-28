
  
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Point</h2>
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
   
<form action="<?php echo e(route('points.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
  
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wampp\www\TrialTask\resources\views/point/create.blade.php ENDPATH**/ ?>