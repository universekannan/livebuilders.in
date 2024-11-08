
<?php $__env->startSection('content'); ?>

<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0">Dashboard</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Dashboard v1</li>
</ol>
</div>
</div>
</div>
</div>

<section class="content">
<div class="container-fluid">

<div class="row">
<div class="col-lg-3 col-6">


<div class="small-box bg-info">
<div class="inner">
<h3><?php echo e($project); ?></h3>
<p>Project</p>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="<?php echo e(url('admin/projects/editproject')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<div class="col-lg-3 col-6">

<div class="small-box bg-danger">
<div class="inner">
<h3><?php echo e($banners); ?></h3>
<p>Banners</p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>
<a href="<?php echo e(url('admin/banners')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
</div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\livebuilders.in\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>