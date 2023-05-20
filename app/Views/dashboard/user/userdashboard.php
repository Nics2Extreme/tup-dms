<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Home</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 bg-success" style="margin-top:30px">
             <div class="text-center p-4 font-bold text-white">
                Dashboard
             </div>
        </div>
    </div>
    <div class="row">
        <a href="<?= site_url('compose'); ?>">Compose</a>
        <a href="<?= site_url('profile'); ?>">Profile</a>
        <a href="<?= site_url('logout'); ?>">Logout</a>
        <div class="col-md-8 offset-md-2">
             <h1>Welcome <?= $userInfo['name']; ?>!</h1>
        </div>
    </div>
</div>

</body>
</html>