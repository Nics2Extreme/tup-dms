<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>How To File Upload in Codeigniter 4 Example Tutorial - Nicesnippets.com</title>
    <!-- <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>"> -->
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

                <div class="flex justify-center">
                    <div class="w-1/2 py-5">
                        <h4 class="text-center">Request Document</h4>
                        <?= csrf_field(); ?>
                        <?php if (!empty(session()->getFlashdata('fail'))): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('fail') ?>
                            </div>
                        <?php endif ?>

                        <?php if (!empty(session()->getFlashdata('success'))): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif ?>
                        <form method="post" action="<?php echo base_url('request'); ?>" enctype="multipart/form-data"
                            class="max-w-md mx-auto">
                            <div class="mb-4">
                                <label for="sender" class="block">Sender</label>
                                <input type="text" class="form-input" name="sender"
                                    value="<?= session()->get('name') ?>" hidden />
                                <select class="form-select w-full rounded-lg border-2" name="receipient" id="receipient">
                                    <option>Select Recipient</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="subject" class="block">Subject</label>
                                <input type="text" class="border border-gray-300 rounded-md p-2 w-full" name="subject"
                                    required />
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block">Description</label>
                                <input type="text" class="border border-gray-300 rounded-md p-2 w-full"
                                    name="description" required />
                            </div>
                            <div class="flex justify-center">
                                <button type="submit"
                                    class="bg-red-500 text-white py-2 px-4 rounded-md">Request</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
</body>
<script>
    $(document).ready(function () {
        loadUsers();
    });

    function loadUsers() {
        $.ajax({
            method: "GET",
            url: "/users",
            success: function (response) {
                console.log(response.users);
                $.each(response.users, function (key, value) {
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