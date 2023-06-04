<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Home</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
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
            <div class="container mx-auto">
                <div class="flex mt-8">
                    <div class="ml-48 w-3/4 pl-8">
                        <div class=" rounded-lg p-4">
                            <div class="text-center font-bold text-2xl">
                                Profile Information
                            </div>
                        </div>
                        <div class="mt-8">
                            <table class="table-auto w-full bg-white border border-gray-300">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-200 text-gray-700">ID</th>
                                        <th class="px-6 py-3 bg-gray-200 text-gray-700">Name</th>
                                        <th class="px-6 py-3 bg-gray-200 text-gray-700">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border px-6 py-4">
                                            <?= $userInfo['id']; ?>
                                        </td>
                                        <td class="border px-6 py-4">
                                            <?= $userInfo['name']; ?>
                                        </td>
                                        <td class="border px-6 py-4">
                                            <?= $userInfo['email']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


</body>

</html>