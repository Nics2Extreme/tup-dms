<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>How To File Upload in Codeigniter 4 Example Tutorial - Nicesnippets.com</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<div class="mx-auto">
        <!-- Sticky Navbar -->
        <div class="sticky top-0 z-50">
            <div class="bg-gray-900 text-white py-2 px-10 justify-end">
                <?php include_once(dirname(__FILE__) . '/../../common/navbar.php'); ?>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex mt-4">
            <div class="w-60 h-screen p-4">
                <!-- Sidebar content here -->
                <?php include_once(dirname(__FILE__) . '/../../common/sidebar.php'); ?>
            </div>
            <div class="ml-1 flex-grow">
                <div class="flex justify-center mt-8">
                    <div class="bg-green-500 p-4 font-bold text-white rounded-md">
                        Dashboard
                    </div>
                </div>

        <div class="row">
            <!-- <a href="<?= site_url('compose'); ?>">Compose</a>
            <a href="<?= site_url(session()->get('userRole')); ?>/<?= session()->get('loggedUser'); ?>">Dashboard</a>
            <a href="<?= site_url('register'); ?>">Register</a>
            <a href="<?= site_url('logout'); ?>">Logout</a> -->
            <div class="col-md-4 col-md-offset-4 py-5">
                <h4>Request Document</h4>
                <?= csrf_field(); ?>
                <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail') ?></div>
                <?php endif ?>

                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif ?>
                <form method="post" action="<?php echo base_url('request'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Receipient</label>
                        <input type="text" class="form-control" name="sender" value="<?= session()->get('name') ?>" hidden />
                        <select class="form-control" name="receipient" id="receipient">
                            <option>Select Receipient</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" class="form-control" name="subject" required />
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" required />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Request</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        loadUsers();
    });

    function loadUsers() {
        $.ajax({
            method: "GET",
            url: "/users",
            success: function(response) {
                console.log(response.users);
                $.each(response.users, function(key, value) {
                    $("#receipient").append(
                        `
                            <option value="${value["name"]}">${value["name"]}</option>
                        `
                    )
                });
            }
        })
    }
</script>

</html>