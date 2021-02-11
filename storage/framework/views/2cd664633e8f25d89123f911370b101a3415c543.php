<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Simple Student Management CRUD Application</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-success " href="<?php echo e(route('students.create')); ?>"> Add Student</a>
        </div>
    </div>

    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <?php echo e($message); ?>

        </div>
    <?php endif; ?>

    <?php if(sizeof($students) > 0): ?>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th width="280px">More</th>
            </tr>
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(++$i); ?></td>
                    <td><?php echo e($student->name); ?></td>
                    <td><?php echo e($student->detail); ?></td>
                    <td>
                        <form action="<?php echo e(route('students.destroy',$student->id)); ?>" method="POST">

                            <a class="btn btn-info" href="<?php echo e(route('students.show',$student->id)); ?>">Show</a>
                            <a class="btn btn-primary" href="<?php echo e(route('students.edit',$student->id)); ?>">Edit</a>

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    <?php else: ?>
        <div class="alert alert-alert">Start Adding to the Database.</div>
    <?php endif; ?>

    <?php echo $students->links(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('students.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>