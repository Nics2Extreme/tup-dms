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
                <?php include_once(dirname(__FILE__) . '/../../common/user-navbar.php'); ?>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex mt-4">
            <div class="w-60 h-screen p-4">
                <!-- Sidebar content here -->
                <?php include_once(dirname(__FILE__) . '/../../common/user-sidebar.php'); ?>
            </div>
            <div class="ml-1 flex-grow">

                <div class="flex justify-center items-center h-screen">
                    <div class="w-full max-w-lg bg-white p-8 shadow-md border-2 rounded-md">
                        <h4 class="text-center text-xl font-semibold mb-6">Create Document</h4>
                        <?= csrf_field(); ?>

                        <?php if (!empty(session()->getFlashdata('fail'))): ?>
                            <div class="bg-red-500 text-white px-4 py-2 mb-4">
                                <?= session()->getFlashdata('fail') ?>
                            </div>
                        <?php endif ?>

                        <?php if (!empty(session()->getFlashdata('success'))): ?>
                            <div class="bg-green-500 text-white px-4 py-2 mb-4">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif ?>

                        <form method="post" action="<?php echo base_url('upload'); ?>" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="receipient" class="block font-medium mb-2">Recipient</label>
                                <input type="text"
                                    class="form-input border-gray-300 rounded-md focus:ring-2 focus:ring-red-500"
                                    name="sender" value="<?= session()->get('name') ?>" hidden />
                                <select class="form-select border-gray-300 rounded-md focus:ring-2 focus:ring-red-500"
                                    name="receipient" id="receipient">
                                    <!-- <option>Select Recipient</option> -->
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="subject" class="block font-medium mb-2">Subject</label>
                                <input type="text"
                                    class="form-input border-gray-300 border-2 rounded-md focus:ring-2 focus:ring-gray-500 w-full"
                                    name="subject" required />
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block font-medium mb-2">Description</label>
                                <input type="text"
                                class="form-input border-gray-300 border-2 rounded-md focus:ring-2 focus:ring-gray-500 w-full"
                                    name="description" required />
                            </div>
                            <div class="mb-4">
                                <label for="file" class="block font-medium mb-2">Upload File</label>
                                <input type="file" name="file"
                                    class="form-input border-gray-300 rounded-md focus:ring-2 focus:ring-red-500"
                                    required>
                            </div>
                            <div class="flex justify-center">
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-md font-medium">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

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
</body>


</html>