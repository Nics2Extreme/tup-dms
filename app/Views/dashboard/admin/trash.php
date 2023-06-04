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

<div class="flex">
    <div class="w-60 h-screen p-4 bg-gray-200">
        <!-- Sidebar content here -->
        <?php include_once(dirname(__FILE__) . '/../../common/header.php'); ?>
    </div>
    <div class="flex-grow pl-8 pr-4">
        <div class="mt-8">
            <div class="col-md-8 offset-md-2 bg-success">
                <div class="text-center p-4 font-bold text-white">
                    Trash Recovery
                </div>
            </div>
        </div>
        <div class="mt-8">
            <div class="col-md-8 offset-md-2">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="bg-red-500 text-white rounded-md p-4 mb-4"><?= session()->getFlashdata('error') ?></div>
                <?php endif ?>

                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="bg-green-500 text-white rounded-md p-4 mb-4"><?= session()->getFlashdata('success') ?></div>
                <?php endif ?>

                <div class="overflow-x-auto">
                    <table class="w-full bg-gray-900 text-white rounded-md">
                        <thead>
                            <tr>
                                <th scope="col" class=" py-3 text-left text-gray-300 uppercase tracking-wider">Doc. Code</th>
                                <th scope="col" class=" py-3 text-left text-gray-300 uppercase tracking-wider">Sender</th>
                                <th scope="col" class=" py-3 text-left text-gray-300 uppercase tracking-wider">Details</th>
                                <th scope="col" class=" py-3 text-left text-gray-300 uppercase tracking-wider">Type</th>
                                <th scope="col" class=" py-3 text-left text-gray-300 uppercase tracking-wider">Date</th>
                                <th scope="col" class=" py-3 text-left text-gray-300 uppercase tracking-wider">Status</th>
                                <th scope="col" class=" py-3 text-left text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="documents">
                            <!-- Table content here -->
                        </tbody>
                    </table>
                </div>

                <div class="container mt-4">
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
</div>




<script>
    $(document).ready(function () {
        loadDocuments();
    });

    function loadDocuments() {
        $.ajax({
            method: "GET",
            url: "/documents",
            success: function (response) {
                $.each(response.documents, function (key, value) {
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
                                        <button class="retrieveBtn bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" data-id="${value.id}" type="button"> 
                                            <i class="bi bi-file-earmark-arrow-up-fill"></i>
                                        </button>
                                        <button class="deleteBtn bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded" data-id="${value.id}" type="button">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </tr>`
                        )
                    }
                });
                $(".retrieveBtn").click(function () {
                    var id = $(this).data("id");
                    $("#documentIdRetrieve").val(id);
                    $("#documentRetrieve").submit();
                });

                $(".deleteBtn").click(function () {
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