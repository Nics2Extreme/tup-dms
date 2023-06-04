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
                <div class="flex justify-center mt-8">
                    <div class="bg-green-500 p-4 font-bold text-white rounded-md">
                        Dashboard
                    </div>
                </div>
                <div class="container flex-grow justify-center overflow-x-auto px-20 mt-8 rounded-md">
                    <table
                        class="table-auto bg-slate-200 w-full rounded-lg overflow-hidden border-2 border-slate-400">
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
                        </thead>
                        <tbody id="documents">
                            <!-- Table rows here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            loadDocuments();
        });

        function loadDocuments() {
            var segment = window.location.pathname.split('/')[2];
            var apiUrl = '/documents/' + segment;
            $.ajax({
                method: "GET",
                url: apiUrl,
                success: function (response) {
                    $.each(response.documents, function (key, value) {
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
                                        <div class="flex">
                                            <a href="<?= site_url('userdocument'); ?>/${value["id"]}" class="badge btn-info view_btn bg-blue-600 hover:text-gray-800 text-white font-bold py-2 px-4 mr-2 rounded"><i class="bi bi-eye-fill"></i></a>
                                            <a href="<?= site_url('trash-document'); ?>/${value["id"]}" class="badge btn-info view_btn bg-gray-600 hover:bg-gray-800 text-white font-bold py-2 px-4 mr-2 rounded"><i class="bi bi-trash2-fill"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            `
                        )
                    });
                }
            })
        }
    </script>

</body>

</html>