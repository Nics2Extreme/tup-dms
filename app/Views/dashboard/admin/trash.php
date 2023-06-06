<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Trash</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                <div class="col-md-8 offset-md-2 ">
                    <div class="text-center p-4 font-bold font-mono text-2xl">
                        Trash Recovery
                    </div>
                </div>
                <div class="mt-8">
                    <div class="flex items-center justify-center ">
                        <div class="col-md-10 offset-md-0">
                            <?php if (!empty(session()->getFlashdata('error'))): ?>
                                <div class="bg-red-500 text-white rounded-md p-4 mb-4">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif ?>

                            <?php if (!empty(session()->getFlashdata('success'))): ?>
                                <div class="bg-green-500 text-white rounded-md p-4 mb-4">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif ?>

                            <div class="container flex-grow justify-center overflow-x-auto px-20 mt-8 rounded-md">
                                <table class="table-auto w-full rounded-lg overflow-hidden shadow-lg border-2 border-slate-400">
                                    <thead>
                                        <tr>
                                            <th scope="col" class=" w-1/6 py-2 text-left bg-gray-800 text-white">
                                                Doc. Code</th>
                                            <th scope="col" class=" w-1/6 py-2 text-left bg-gray-800 text-white">
                                                Sender</th>
                                            <th scope="col" class=" w-1/6 py-2 text-left bg-gray-800 text-white">
                                                Details</th>
                                            <th scope="col" class=" w-1/6 py-2 text-left bg-gray-800 text-white">
                                                Type</th>
                                            <th scope="col" class=" w-1/6 py-2 text-left bg-gray-800 text-white">
                                                Date</th>
                                            <th scope="col" class=" w-1/6 py-2 text-left bg-gray-800 text-white">
                                                Status</th>
                                            <th scope="col" class=" w-1/6 py-2 text-left bg-gray-800 text-white">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="documents" class="bg-gray-300">
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
                                            <div class="flex justify-center">
                                            <button class="retrieveBtn bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 mr-2 rounded" data-id="${value.id}" type="button"> 
                                                <i class="bi bi-file-earmark-arrow-up-fill"></i>
                                            </button>
                                            <button class="deleteBtn bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 mr-2 rounded" data-id="${value.id}" type="button">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                            </div>
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