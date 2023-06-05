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
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="bg-success mt-8 p-4 font-bold">

            </div>
        </div>

        <div class="container mx-auto">
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
                    const fileName = 'image.png';
                    
                    if (response.document.action === 'document') {
                        $("#document").html(`
                        <div id="download"></div>
                    <form method="post" action="<?php echo base_url('receive'); ?>" enctype="multipart/form-data">
                        <input type="text" name="id" class="form-control" value="${response.document.id}" hidden />
                        <img src="<?= base_url('src/') ?>qrcode${response.document.id}.png" alt='qr' />
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
                            <input type="text" id="sender" class="form-control" value="${response.document.sender}" disabled />
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Set as Received</button>
                    </div>
                    </form>
                    `);

                        if (response.document.status === "1") {
                            $('#download').append(`
                                <div class="mb-4 ">
                                    <div class="flex items-center">
                                        <span class="mr-2">${response.document.name}</span>
                                        <a href="<?= site_url('download') ?>/${response.document.name}" target="_blank" class="text-blue-500 hover:underline">Download</a>
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
                    <div class="form-group" id="upload">
                        <label>Upload File</label>
                        <input type="file" name="file" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Send Document</button>
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