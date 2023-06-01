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
            <a href="<?= site_url('admin'); ?>">Dashboard</a>
            <a href="<?= site_url('register'); ?>">Register</a>
            <a href="<?= site_url('logout'); ?>">Logout</a>
        </div>
        <div class="container">
            <div id="download"></div>
            <form id="document" method="post" action="<?php echo base_url('trash-document'); ?>"></form>
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
                        <div id="download"></div>
                        <form method="post" action="<?php echo base_url('trash-document'); ?>">
                    <input type="text" name="id" class="form-control" value="${response.document.id}" hidden />
                    <div class="form-group">
                        <div class="col">
                            <label for="sender">Document Code</label>
                            <input type="text" id="sender" class="form-control" value="${response.document.id}" disabled />
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" class="form-control" value="${response.document.subject}" disabled />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col">
                        <label for="description">Description</label>
                        <input type="text" id="description" class="form-control" value="${response.document.description}" disabled />
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <label for="sender">Sender</label>
                            <input type="text" id="dender" class="form-control" value="${response.document.sender}" disabled />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <label for="sender">Date Created</label>
                            <input type="text" id="dender" class="form-control" value="${response.document.createdAt}" disabled />
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Trash Document</button>
                    </div>
                    </form>
                    `);
                    }
                
            })
        }
    </script>
</body>

</html>