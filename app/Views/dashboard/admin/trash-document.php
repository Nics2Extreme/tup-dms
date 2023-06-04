<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Trash</title>

    <!-- <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body ">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 ">
            <!-- Sidebar content here -->
            <?php include_once(dirname(__FILE__) . '/../../common/header.php'); ?>
        </div>

        <!-- Main Content -->
        <div class="flex-grow flex items-center justify-center">
            <div class="w-1/2">
                <div class="text-4xl font-bold mb-8 py-5 px-11 flex items-center justify-center">
                    Trash <i class="bi bi-trash-fill"></i>
                </div>

                <div class="container mx-auto">
                    <div id="download"></div>
                    <form id="document" method="post" action="<?php echo base_url('trash-document'); ?>"></form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function () {
        loadDocuments();
    });

    function loadDocuments() {
        var segment = window.location.pathname.split('/')[2];
        var apiUrl = '/find/' + segment;
        console.log(segment)
        $.ajax({
            method: "GET",
            url: apiUrl,
            success: function (response) {
                $("#document").html(`
                        <div id="download"></div>
                        <form method="post" action="<?php echo base_url('trash-document'); ?>">
                    <input type="text" name="id" class="hidden" value="${response.document.id}" />
                    <div class="mb-4">
                        <label for="sender" class="block text-sm font-medium text-gray-700 mb-2">Document Code</label>
                        <input type="text" id="sender" class="form-input px-4 py-3 rounded-md border-gray-300 bg-gray-300 text-gray-800 w-full" value="${response.document.id}" disabled />
                    </div>
                    <div class="mb-4">
                      <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                      <input type="text" id="subject" class="form-input px-4 py-3 rounded-md border-gray-300 bg-gray-300 text-gray-800 w-full" value="${response.document.subject}" disabled />
                    </div>
                    <div class="mb-4">
                      <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                      <input type="text" id="description" class="form-input px-4 py-3 rounded-md border-gray-300 bg-gray-300 text-gray-800 w-full" value="${response.document.description}" disabled />
                    </div>
                    <div class="mb-4">
                        <label for="sender" class="block text-sm font-medium text-gray-700 mb-2">Sender</label>
                        <input type="text" id="sender" class="form-input px-4 py-3 rounded-md border-gray-300 bg-gray-300 text-gray-800 w-full" value="${response.document.sender}" disabled />
                    </div>
                    <div class="mb-4">
                        <label for="sender" class="block text-sm font-medium text-gray-700 mb-2">Date Created</label>
                        <input type="text" id="sender" class="form-input px-4 py-3 rounded-md border-gray-300 bg-gray-300 text-gray-800 w-full" value="${response.document.createdAt}" disabled />
                    </div>
                    <div class="mt-8">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-md w-full" type="submit">Trash Document</button>
                    </div>
                    </form>
                    `);
            }
        })
    }
</script>
</body>



</html>