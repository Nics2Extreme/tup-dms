<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Trash</title>
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
                <table class="table table-dark">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif ?>

                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif ?>
                    <thead>
                        <tr>
                            <th scope="col">Doc. Code</th>
                            <th scope="col">Sender</th>
                            <th scope="col">Details</th>
                            <th scope="col">Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="documents"></tbody>
                </table>
                <div class="container">
                    <form id="documentRetrieve" method="post" action="<?= site_url('retrieve-document'); ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" id="documentIdRetrieve" value="">
                    </form>
                    <form id="documentDelete" method="post" action="<?= site_url('delete-document'); ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" id="documentIdDelete" value="">
                    </form>
                </div>
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
                        if (value.status == "2") {
                            $("#documents").append(
                                `<tr>
                                    <td>${value["id"]}</td>
                                    <td>${value["sender"]}</td>
                                    <td>${value["description"]}</td>
                                    <td>${value["action"]}</td>
                                    <td>${value["createdAt"]}</td>
                                    <td>${value["status"] == "2" ? "Trashed" : ""}</td>
                                    <td>
                                        <button class="retrieveBtn" data-id="${value.id}" type="button">Retrieve</button>
                                        <button class="deleteBtn" data-id="${value.id}" type="button">Delete</button>
                                    </td>
                                </tr>`
                            )
                        }
                    });
                    $(".retrieveBtn").click(function() {
                        var id = $(this).data("id");
                        $("#documentIdRetrieve").val(id);
                        $("#documentRetrieve").submit();
                    });

                    $(".deleteBtn").click(function() {
                        var id = $(this).data("id");
                        $("#documentIdDelete").val(id);
                        $("#documentDelete").submit();
                    });
                }
            })
        }
    </script>
</body>
</html>
