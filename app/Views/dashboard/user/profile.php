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
                    Profile
                </div>
            </div>
        </div>
        <div class="row">
            <a href="<?= site_url('usercompose'); ?>">Compose</a>
            <a href="<?= site_url('userrequest'); ?>">Request</a>
            <a href="<?= site_url('user'); ?>/<?= session()->get('loggedUser') ?>">Dashboard</a>
            <a href="<?= site_url('logout'); ?>">Logout</a>
            <div class="col-md-8 offset-md-2">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $userInfo['id']; ?></td>
                            <td><?= $userInfo['name']; ?></td>
                            <td><?= $userInfo['email']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>