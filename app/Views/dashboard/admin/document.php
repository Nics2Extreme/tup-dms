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
            <a href="<?= site_url('admin'); ?>">Dashboard</a>
            <a href="<?= site_url('register'); ?>">Register</a>
            <a href="<?= site_url('logout'); ?>">Logout</a>
        </div>
        <div class="container">
            <form id="document"></form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            loadDocuments();
        });

        function loadDocuments() {
            var segment = window.location.pathname.split('/')[2];
            var apiUrl = '/find/' + segment;
            console.log(segment)
            $.ajax({
                method: "GET",
                url: apiUrl,
                success: function(response) {
                    $("#document").html(`
                    <div class="form-group">
                      <div class="col">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" class="form-control" placeholder=${response.document.subject} disabled />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col">
                        <label for="description">Description</label>
                        <input type="text" id="description" class="form-control" placeholder=${response.document.description} disabled />
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <label for="sender">Sender</label>
                            <input type="text" id="dender" class="form-control" placeholder=${response.document.sender} disabled />
                        </div>
                        <div class="col">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" placeholder=${response.document.name} disabled />
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col">
                        <label for="attachment">Attachment</label>
                      </div>
                      <div class="col">
                        <span>${response.document.name}</span>
                        <a href="<?= site_url('download') ?>/${response.document.name}" target="_blank">Download</a>
                      </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Set as Received</button>
                    </div>
                    `);
                }
            })
        }
    </script>
</body>

</html>