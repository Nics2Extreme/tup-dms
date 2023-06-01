<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Home</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                    </thead>
                    <tbody id="documents"></tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            loadDocuments();
        });

        function loadDocuments() {
            $.ajax({
                method: "GET",
                url: "/documents",
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
                    });
                }
            })
        }
    </script>
</body>
</html>