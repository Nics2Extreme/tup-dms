<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="../dist/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-slate-100">
    <div class="flex items-center justify-center h-screen">
        <div class="w-full max-w-md">
            <img src="<?= base_url('src/cos.png') ?>" alt="Logo" class="mx-auto mb-6">
            <h4 class="text-xl font-bold mb-6 text-center">College of Science Document Tracking and Management System</h4>
            <?= csrf_field(); ?>
            <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                <div class="bg-red-500 text-white p-4 mb-6">
                    <?= session()->getFlashdata('fail') ?>
                </div>
            <?php endif ?>

            <form action="<?= base_url('check') ?>" method="post">
                <div class="login">
                    <div class="mb-6">
                        <label class="block mb-2 font-semibold" for="email">Email:</label>
                        <input type="text" class="w-full px-4 py-2 rounded-md border-2" name="email" id="email" placeholder="Enter your email" value="<?= set_value('email'); ?>" />
                        <small class="text-red-500">
                            <?= isset($validation) ? display_error($validation, 'email') : '' ?>
                        </small>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-semibold" for="password">Password:</label>
                        <input type="password" class="w-full px-4 py-2 rounded-md border-2" name="password" id="password" placeholder="Enter your password" />
                        <small class="text-red-500">
                            <?= isset($validation) ? display_error($validation, 'password') : '' ?>
                        </small>
                    </div>
                    <div class="mb-6">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md w-full flex items-center justify-center" type="button" onclick='send_otp()'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            Sign In
                        </button>
                    </div>
                </div>
                <div class="otp hidden">
                    <div class="mb-6">
                        <label class="block mb-2 font-semibold" for="password">OTP:</label>
                        <input type="text" class="w-full px-4 py-2 rounded-md border-2" name="otp" id="otp" placeholder="Enter OTP" required/>
                    </div>
                    <div class="mb-6">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md w-full flex items-center justify-center" type="submit" id="submit" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            Submit OTP
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    function send_otp() {
        var email = $('#email').val();
        $.ajax({
            url: '/otp',
            type: "POST",
            data: {
                email: email
            },
            success: function(result) {
                if (result === 'yes') {
                    $('.login').hide();
                    $('.otp').show();
                    $('#submit').prop('disabled', false);
                }
            }
        });
    }
    $(document).ready(function() {

    });
</script>
</body>

</html>