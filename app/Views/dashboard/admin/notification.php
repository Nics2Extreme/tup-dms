<!DOCTYPE html>
<html>

<head>
    <title>Notification using PHP Ajax Bootstrap</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <br /><br />
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">PHP Notification Tutorial</a>
                </div>
            </div>
        </nav>
        <br />
        <form method="post" id="comment_form">
            <div class="form-group">
                <label>Enter Subject</label>
                <input type="text" name="subject" id="subject" class="form-control">
            </div>
            <div class="form-group">
                <label>Enter reminder date</label>
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="form-group">
                <label>Enter Comment</label>
                <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
            </div>
        </form>

    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#comment_form').on('submit', function(e) {
            e.preventDefault();
            if ($('#subject').val() != '' && $('#date').val() != '' && $('#comment').val() != '') {
                var form_data = $(this).serialize();
                $.ajax({
                    url: "/createnotif",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        $('#comment_form')[0].reset();
                    }
                });
            } else {
                alert("All fields are required");
            }
        });
    });
</script>