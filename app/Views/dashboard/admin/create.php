<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>How To File Upload in Codeigniter 4 Example Tutorial - Nicesnippets.com</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
<<<<<<< HEAD
    <script src="https://cdn.tailwindcss.com"></script>
=======
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
>>>>>>> 4197850ed52b77ecc82608e22150db4f789c786f
</head>

<body class="bg-slate-100">
    <div class="container flex mx-auto justify-end">
        <?php include_once(dirname(__FILE__) . '/../../common/header.php'); ?>
        <div class="w-4/5">
            <div class="container mx-auto">
                <div class="flex justify-center mt-2">
                    <div class="bg-green-500 px-6 py-4 rounded-lg">
                        <h2 class="text-2xl font-bold text-white">User Management</h2>
                    </div>
                </div>
                <div class="flex justify-center mt-8">
                    <div class="w-3/4 bg-white rounded-lg shadow-lg p-6 border-2 border-slate-400">
                        <h4 class="text-2xl font-bold mb-6">Create Document</h4>
                        <?= csrf_field(); ?>
                        <?php if (!empty(session()->getFlashdata('fail'))): ?>
                            <div class="bg-red-200 text-red-800 px-4 py-2 rounded mb-4">
                                <?= session()->getFlashdata('fail') ?>
                            </div>
                        <?php endif ?>
                        <?php if (!empty(session()->getFlashdata('success'))): ?>
                            <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif ?>
                        <form action="<?= base_url('upload') ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="sender" class="block text-gray-700 font-bold">Sender</label>
                                <input type="text" class="form-input w-full border border-gray-300 rounded px-4 py-2"
                                    name="sender" id="sender" placeholder="Enter sender" />
                            </div>
                            <div class="mb-4">
                                <label for="recipient" class="block text-gray-700 font-bold">Recipient</label>
                                <input type="text" class="form-input w-full border border-gray-300 rounded px-4 py-2"
                                    name="recipient" id="recipient" placeholder="Enter recipient" />
                            </div>
                            <div class="mb-4">
                                <label for="subject" class="block text-gray-700 font-bold">Subject</label>
                                <input type="text" class="form-input w-full border border-gray-300 rounded px-4 py-2"
                                    name="subject" id="subject" placeholder="Enter subject" />
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-gray-700 font-bold">Description</label>
                                <input type="text" class="form-input w-full border border-gray-300 rounded px-4 py-2"
                                    name="description" id="description" placeholder="Enter description" />
                            </div>
                            <div class="mb-4">
                                <label for="file" class="block text-gray-700 font-bold">Upload File</label>
                                <input type="file" class="hidden" id="file" name="file" />
                                <label for="file"
                                    class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                                    Select File
                                </label>
                                <span id="file-name" class="ml-2"></span>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn text-black btn-danger">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD
=======

        <div class="row">
            <a href="<?= site_url(session()->get('userRole')); ?>">Dashboard</a>
            <a href="<?= site_url('register'); ?>">Register</a>
            <a href="<?= site_url('logout'); ?>">Logout</a>
            <div class="col-md-4 col-md-offset-4 py-5">
                <h4>Create Document</h4>
                <?= csrf_field(); ?>
                <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail') ?></div>
                <?php endif ?>

                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif ?>
                <form method="post" action="<?php echo base_url('upload'); ?>" enctype="multipart/form-data">
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
                        <label>Upload File</label>
                        <input type="file" name="file" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Upload</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
>>>>>>> 4197850ed52b77ecc82608e22150db4f789c786f
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