<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sidebar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- <script src="./tailwind3.js"></script> -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body class="font-[Poppins]">
  <span class="absolute text-white text-4xl top-5 left-4 " onclick="Openbar()">
    <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
  </span>
  <div
    class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-1000 p-2 w-[250px] overflow-y-auto text-center bg-gray-900 shadow h-screen">
    <div class="text-gray-100 text-xl">
      <div class="p-2.5 mt-1 flex items-center rounded-md">
        <img src="<?= base_url('src/cos.png') ?>" alt="Logo" class="w-14 h-14 px-2 py-1 rounded-md">
        <!-- <i src="<?= base_url('src/cos.png') ?>" alt="Logo" class="px-2 py-1 rounded-md"></i> -->
        <h1 class="text-[15px] text-md text-gray-200 font-bold">College of Science</h1>
        <i class="bi bi-x ml-20  lg:hidden" onclick="Openbar()"></i>
      </div>
      <hr class="my-2 text-gray-600">

      <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300  bg-gray-700">
        <i class="bi bi-search text-sm"></i>
        <input class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" placeholder="Search" />
      </div>
      <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300  hover:bg-blue-600" onclick="dropDown()">
        <i class="bi bi-bell-fill"></i>
        <div class="flex justify-between w-full items-center">
          <span class="text-[15px] ml-4 text-gray-200">Notifications</span>
          <span class="text-sm rotate-180" id="arrow">
            <i class="bi bi-chevron-down"></i>
          </span>
        </div>
      </div>
      <div class="leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto hidden" id="submenu">
        <h1 class="p-2 rounded-md mt-1">TEST</h1>
        <h1 class="p-2 rounded-md mt-1">TEST2</h1>
        <h1 class="p-2 rounded-md mt-1">TEST3</h1>
      </div>

      <a href="<?= site_url(session()->get('userRole')); ?>"
        class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 hover:bg-blue-600">
        <i class="bi bi-house-door-fill"></i>
        <span class="text-[15px] ml-4 text-gray-200">Home</span>
      </a>
      <a href="<?= site_url('compose'); ?>"
        class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 hover:bg-blue-600">
        <i class="bi bi-bookmark-fill"></i>
        <span class="text-[15px] ml-4 text-gray-200">Compose</span>
      </a>
      <a href="<?= site_url('request'); ?>"
        class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 hover:bg-blue-600">
        <i class="bi bi-file-earmark-arrow-down-fill"></i>
        <span class="text-[15px] ml-4 text-gray-200">Request</span>
      </a>
      <a href="<?= site_url('register'); ?>"
        class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 hover:bg-blue-600">
        <i class="bi bi-pencil-fill"></i>
        <span class="text-[15px] ml-4 text-gray-200">Register</span>
      </a>
      <a href="<?= site_url('view_trash'); ?>"
        class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 hover:bg-blue-600">
        <i class="bi bi-trash-fill"></i>
        <span class="text-[15px] ml-4 text-gray-200">Trash</span>
      </a>
      <hr class="my-4 text-gray-600">
      <!-- <a href="<?= site_url('messages'); ?>"
        class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 hover:bg-blue-600">
        <i class="bi bi-envelope-fill"></i>
        <span class="text-[15px] ml-4 text-gray-200">Messages</span>
      </a> -->
      <!-- <a href="<?= site_url('logout'); ?>"
        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 hover:bg-blue-600">
        <i class="bi bi-box-arrow-in-right"></i>
        <span class="text-[15px] ml-4 text-gray-200">Logout</span>
      </a> -->

    </div>
  </div>

  <script>
    function dropDown() {
      var submenu = document.querySelector('#submenu');
      var arrow = document.querySelector('#arrow');

      // Toggle the hidden class to show/hide the dropdown
      submenu.classList.toggle('hidden');

      // Toggle the rotate-0 class after a small delay
      setTimeout(function () {
        arrow.classList.toggle('rotate-0');
      }, 10);
    }

    // Hide the dropdown initially
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelector('#submenu').classList.add('hidden');
    });


    // Hide the dropdown initially
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelector('#submenu').classList.add('hidden');
    });


    // Hide the dropdown initially
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelector('#submenu').classList.add('hidden');
    });

    function Openbar() {
      document.querySelector('.sidebar').classList.toggle('left-[-300px]');
    }

    dropDown();
  </script>
</body>


</html>