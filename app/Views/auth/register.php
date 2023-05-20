<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 bg-success" style="margin-top:30px">
             <div class="text-center p-4 font-bold text-white">
                Register
             </div>
        </div>
    </div>
        <div class="row" style="margin-top:45px">
        <a href="<?= site_url('compose'); ?>">Compose</a>
        <a href="<?= site_url('admin'); ?>">Dashboard</a>
        <a href="<?= site_url('logout'); ?>">Logout</a>
            <div class="col-md-4 col-md-offset-4 py-5">
                <h4>Sign Up</h4>
                <?= csrf_field(); ?>
                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail') ?></div>
                <?php endif ?>

                <?php if(!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif ?>
                <form action="<?= base_url('save')?>" method="post">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?= set_value('name');?>"/>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter your email" value="<?= set_value('email');?>"/>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <input type="text" class="form-control" name="role" placeholder="Enter user role" value="<?= set_value('role');?>"/>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'role') : '' ?></span>
                    </div>
                    <div class="form-group">
                    <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password"/>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                    </div>
                    <label for="">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" placeholder="Enter your password again"/>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>