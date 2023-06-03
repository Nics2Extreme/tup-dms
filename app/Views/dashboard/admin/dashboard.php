<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Home</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    
    <div class="container mx-auto flex">
        <div class="w-60 h-screen p-4">
            <!-- Sidebar content here -->
            <?php include_once(dirname(__FILE__) . '/../../common/header.php'); ?>
        </div>
        <div class="ml-8 flex-grow">
            <div class="flex justify-center mt-8">
                <div class="bg-green-500 p-4 font-bold text-white rounded-md">
                    Dashboard
                </div>
            </div>
<<<<<<< HEAD
            <!-- <div class="flex justify-center mt-4">
                <a href="<?= site_url('compose'); ?>" class="mr-2">Compose</a>
                <a href="<?= site_url('register'); ?>" class="mr-2">Register</a>
                <a href="<?= site_url('logout'); ?>">Logout</a>
            </div> -->
            <div class="flex justify-center mt-8">
                <div class="col-span-8 ">
                    <h1 class="text-black font-mono text-lg">Welcome
                        <?= $userInfo['name']; ?>!
                    </h1>
                </div>
            </div>
            <div class="flex justify-center mt-8">
                <table class="table-auto bg-slate-200 w-full rounded-md overflow-hidden shadow-lg border-2 border-slate-300">
                    <thead>
                        <tr>
                            <th class="w-1/6 py-2 text-left bg-gray-800 text-white">Doc. Code</th>
                            <th class="w-1/6 py-2 text-left bg-gray-800 text-white">Sender</th>
                            <th class="w-1/6 py-2 text-left bg-gray-800 text-white">Details</th>
                            <th class="w-1/6 py-2 text-left bg-gray-800 text-white">Required Actions</th>
                            <th class="w-1/6 py-2 text-left bg-gray-800 text-white">Date of Letter</th>
                            <th class="w-1/6 py-2 text-left bg-gray-800 text-white">Status</th>
                            <th class="w-1/6 py-2 text-left bg-gray-800 text-white">Actions</th>
                        </tr>
=======
        </div>
        <div class="row">
            <a href="<?= site_url('compose'); ?>">Compose</a>
            <a href="<?= site_url('request'); ?>">Request</a>
            <a href="<?= site_url('view_trash'); ?>">Trash</a>
            <a href="<?= site_url('register'); ?>">Register</a>
            <a href="<?= site_url('logout'); ?>">Logout</a>
            <div class="col-md-8 offset-md-2">
                <h1>Welcome <?= $userInfo['name']; ?>!</h1>
            </div>
            <div class="col-md-8 offset-md-2">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif ?>

                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif ?>
                <table class="table table-dark">
                    <thead>
                        <th scope="col-2">Doc. Code</th>
                        <th scope="col-4">Sender</th>
                        <th scope="col-4">Details</th>
                        <th scope="col-4">Type</th>
                        <th scope="col-4">Date</th>
                        <th scope="col-4">Status</th>
                        <th scope="col-4">Actions</th>
>>>>>>> 4197850ed52b77ecc82608e22150db4f789c786f
                    </thead>
                    <tbody id="documents">
                        <!-- Table rows here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function () {
            loadDocuments();
        });

        function loadDocuments() {
            $.ajax({
                method: "GET",
                url: "/documents",
<<<<<<< HEAD
                success: function (response) {
                    $.each(response.documents, function (key, value) {
                        $("#documents").append(
                            `
                                <tr>
                                    <td scope="row">${value["id"]}</td>
                                    <td>${value["sender"]}</td>
                                    <td>${value["description"]}</td>
                                    <td>Insert action</td>
                                    <td>Insert date</td>
                                    <td>Insert Status</td>
                                    <td>
                                        <a href="<?= site_url('document'); ?>/${value["id"]}" class="badge btn-info view_btn">View</a>
                                    </td>
                                </tr>
                            `
                        )
=======
                success: function(response) {
                    $.each(response.documents, function(key, value) {
                        if (value.status !== "2") {
                            $("#documents").append(
                                `
                                    <tr>
                                        <td scope="row">${value["id"]}</td>
                                        <td>${value["sender"]}</td>
                                        <td>${value["description"]}</td>
                                        <td>${value["action"]}</td>
                                        <td>${value["createdAt"]}</td>
                                        <td>${value["status"] === "0" ? "Pending" : "Received"}</td>
                                        <td>
                                            <a href="<?= site_url('document'); ?>/${value["id"]}" class="badge btn-info view_btn">View</a>
                                            <a href="<?= site_url('trash-document'); ?>/${value["id"]}" class="badge btn-info view_btn">Trash</a>
                                        </td>
                                    </tr>
                                `
                            )
                        }
>>>>>>> 4197850ed52b77ecc82608e22150db4f789c786f
                    });
                }
            })
        }
    </script>
</body>
</html>