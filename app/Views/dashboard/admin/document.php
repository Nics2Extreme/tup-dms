<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body class="bg-slate-100">
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

            <div class="container mx-32">
                <div id="document" class="bg-white shadow-lg rounded px-8 py-6 mt-8 border-2">
                    <form method="post" action="<?php echo base_url('receive'); ?>" enctype="multipart/form-data">
                        <input type="text" name="id" class="hidden" value="${response.document.id}" />
                        <div class="mb-4">
                            <label for="subject" class="block text-gray-700 font-bold">Subject</label>
                            <input type="text" id="subject"
                                class="form-input w-full border border-gray-300 rounded px-4 py-2"
                                value="${response.document.subject}" disabled />
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold">Description</label>
                            <input type="text" id="description"
                                class="form-input w-full border border-gray-300 rounded px-4 py-2"
                                value="${response.document.description}" disabled />
                        </div>
                        <div class="mb-4">
                            <label for="sender" class="block text-gray-700 font-bold">Sender</label>
                            <input type="text" id="sender"
                                class="form-input w-full border border-gray-300 rounded px-4 py-2"
                                value="${response.document.sender}" disabled />
                        </div>

                        <div class="mb-4">
                            <button class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded"
                                type="submit">Set as Received</button>
                        </div>

                        <div id="upload">
                            <label for="file" class="block text-gray-700 font-bold">Upload File</label>
                            <input type="file" name="file" class="hidden" id="file" required />
                            <label for="file"
                                class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                                Select File
                            </label>
                            <span id="file-name" class="ml-2"></span>
                        </div>

                        <div class="mb-4">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full"
                                type="submit">Send Document</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                loadDocuments();
            });

            function loadDocuments() {
                var segment = window.location.pathname.split('/')[2];
                var apiUrl = '/find/' + segment;
                console.log(segment)
                $.ajax({
                    method: "GET",
                    url: apiUrl,
                    success: function (response) {
                        const fileName = 'image.png';

                        if (response.document.action === 'document') {
                            $("#document").html(`
                        <div id="download"></div>
                    <form method="post" action="<?php echo base_url('receive'); ?>" enctype="multipart/form-data">
                        <input type="text" name="id" class="form-control" value="${response.document.id}" hidden />
                        <img src="<?= base_url('src/') ?>qrcode${response.document.id}.png" alt='qr' />
                    <div class="form-group">
                      <div class="col">
                        <label for="subject" class="block text-gray-700 font-bold">Subject</label>
                        <input type="text" id="subject" class="form-input w-full border border-gray-300 rounded px-4 py-2" value="${response.document.subject}" disabled />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col">
                        <label for="description" class="block text-gray-700 font-bold">Description</label>
                        <input type="text" id="description" class="form-input w-full border border-gray-300 rounded px-4 py-2" value="${response.document.description}" disabled />
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <label for="sender" class="block text-gray-700 font-bold">Sender</label>
                            <input type="text" id="sender" class="form-input w-full border border-gray-300 rounded px-4 py-2" value="${response.document.sender}" disabled />
                        </div>
                    </div>
                    <div class="mb-4">
                        <button class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-md"
                            type="submit">Set as Received</button>
                    </div>
                    </form>
                    `);

                            if (response.document.status === "1") {
                                $('#download').append(`
                                <div class="mb-4 ">
                                    <div class="flex items-center">
                                        <span class="font-bold text-center">${response.document.name}</span>
                                        <a href="<?= site_url('download') ?>/${response.document.name}"
                                            class=" ml-4 p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 bg-blue-300 hover:bg-blue-600">
                                            <i class="bi bi-download"></i>
                                            <span class="text-[15px] ml-4 text-black font-bold">Download</span>
                                        </a>
                                    </div>
                                </div>
                            `);
                            }

                        } else {
                            $("#document").html(`
                        <div id="download"></div>
                        <form method="post" action="<?php echo base_url('send'); ?>" enctype="multipart/form-data">
                    <input type="text" name="id" class="form-control" value="${response.document.id}" hidden />
                    <div class="form-group">
                      <div class="col">
                        <label for="subject" class="block text-gray-700 font-bold">Subject</label>
                        <input type="text" id="subject" class="form-input w-full border border-gray-300 rounded px-4 py-2" value="${response.document.subject}" disabled />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col">
                        <label for="description class="block text-gray-700 font-bold">Description</label>
                        <input type="text" id="description" class="form-input w-full border border-gray-300 rounded px-4 py-2" value="${response.document.description}" disabled />
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <label for="sender" class="block text-gray-700 font-bold">Sender</label>
                            <input type="text" id="dender" class="form-input w-full border border-gray-300 rounded px-4 py-2" value="${response.document.sender}" disabled />
                        </div>
                    </div>
                    <div class="form-group" id="upload">
                        <label class="block text-gray-700 font-bold">Upload File</label>
                        <input class"" type="file" name="file" class="form-input w-full border border-gray-300 rounded px-4 py-2" required />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-md" type="submit">Send Document</button>
                    </div>
                    </form>
                    `);
                            if (response.document.status === "1") {
                                $('#download').append(`
                                <div class="mb-4">
                                    <div class="flex items-center">
                                        <span class="mr-2">${response.document.name}</span>
                                        <a href="<?= site_url('download') ?>/${response.document.name}" target="_blank" class="text-blue-500 hover:underline">Download</a>
                                    </div>
                                </div>
                            `);

                                $('#upload').hide();
                            }
                        }
                    }
                })
            }
        </script>
</body>




</html>