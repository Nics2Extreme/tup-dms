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
            <a href="<?= site_url('usercompose'); ?>">Compose</a>
            <a href="<?= site_url('profile'); ?>">Profile</a>
            <a href="<?= site_url('logout'); ?>">Logout</a>
            <div class="col-md-8 offset-md-2">
                <h1>Welcome <?= $userInfo['name']; ?>!</h1>
            </div>
            <div class="col-md-8 offset-md-2">
                <table class="table table-dark">
                    <thead>
                        <th scope="col-2">Doc. Code</th>
                        <th scope="col-4">Sender</th>
                        <th scope="col-4">Details</th>
                        <th scope="col-4">Required Actions</th>
                        <th scope="col-4">Date of Letter</th>
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
            var segment = window.location.pathname.split('/')[2];
            var apiUrl = '/documents/' + segment;
            $.ajax({
                method: "GET",
                url: apiUrl,
                success: function(response) {
                    $.each(response.documents, function(key, value) {
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
                                        <a href="<?= site_url('userdocument'); ?>/${value["id"]}" class="badge btn-info view_btn">View</a>
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