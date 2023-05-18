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
        <div class="row" style="margin-top:45px">
            <div class="col-md-4 col-md-offset-4">
                <h4>Sign In</h4>
                <?= csrf_field(); ?>
                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail') ?></div>
                <?php endif ?>

                <form action="<?= base_url('check')?>" method="post">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter your email" value="<?= set_value('email'); ?>"/>
                        <small class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></small>
                    </div>
                    <div class="form-group">
                    <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password"/>
                        <small class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></small>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>