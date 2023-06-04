<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sidebar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- <script src="./tailwind3.js"></script> -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body class="font-[Poppins]">
  <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer" onclick="Openbar()">
    <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
  </span>
  <div class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-1000 p-2 w-[250px] overflow-y-auto text-center bg-gray-900 shadow h-screen">
    <div class="text-gray-100 text-xl">
      <div class="p-2.5 mt-1 flex items-center rounded-md">
        <img src="<?= base_url('src/cos.png') ?>" alt="Logo" class="w-14 h-14 px-2 py-1 rounded-md">
        <!-- <i src="<?= base_url('src/cos.png') ?>" alt="Logo" class="px-2 py-1 rounded-md"></i> -->
        <h1 class="text-[15px] text-md text-gray-200 font-bold">College of Science</h1>
        <i class="bi bi-x ml-20 cursor-pointer lg:hidden" onclick="Openbar()"></i>
      </div>
      <hr class="my-2 text-gray-600">

      <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700">
        <i class="bi bi-search text-sm"></i>
        <input class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" placeholder="Search" />
      </div>

      <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300  hover:bg-blue-600" onclick="dropDown()">
        <i class="bi bi-bell-fill"></i>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <div class="flex justify-between w-full items-center" id="dropdown-menu">
            <span class="text-[15px] ml-4 text-gray-200">Notifications</span>
            <span class="w-8 rounded-full bg-red-500 text-white count" style="border-radius:10px;"></span>
            <span class="text-sm rotate-180" id="arrow">
              <i class="bi bi-chevron-down arrow"></i>
            </span>
          </div>
        </a>
      </div>
      <div class="leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto" id="submenu"></div>


      <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="bi bi-house-door-fill"></i>
        <a href="<?= site_url(session()->get('userRole')); ?>" class="text-[15px] ml-4 text-gray-200">Home</a>
      </div>
      <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="bi bi-bookmark-fill"></i>
        <a href="<?= site_url('compose'); ?>" class="text-[15px] ml-4 text-gray-200">Compose</a>
      </div>
      <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="bi bi-pencil-fill"></i>
        <a href="<?= site_url('register'); ?>" class="text-[15px] ml-4 text-gray-200">Register</a>
      </div>
      <hr class="my-4 text-gray-600">
      <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="bi bi-envelope-fill"></i>
        <span class="text-[15px] ml-4 text-gray-200">Messages</span>
      </div>

      <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600" onclick="dropDown()">
        <i class="bi bi-chat-left-text-fill"></i>
        <div class="flex justify-between w-full items-center">
          <span class="text-[15px] ml-4 text-gray-200">Chatbox</span>
          <span class="text-sm rotate-180" id="arrow">
            <i class="bi bi-chevron-down"></i>
          </span>
        </div>
      </div>
      <div class="leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto hidden" id="submenu">
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Social</h1>
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Personal</h1>
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Friends</h1>
      </div>

      <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="bi bi-box-arrow-in-right"></i>
        <a href="<?= site_url('logout'); ?>" class="text-[15px] ml-4 text-gray-200">Logout</a>
        <!-- <span class="text-[15px] ml-4 text-gray-200">Logout</span> -->
      </div>
    </div>
  </div>

  <script>
    function dropDown() {
      var submenu = document.querySelector('#submenu');
      var arrow = document.querySelector('#arrow');

      submenu.classList.toggle('hidden');
      arrow.classList.toggle('rotate-0');

    }

    function Openbar() {
      document.querySelector('.sidebar').classList.toggle('left-[-300px]');
    }

    dropDown();

    $(document).ready(function() {
      var segment = "test"
      var url = '/fetchnotif/' + segment;

      function load_unseen_notification(view = '') {
        $.ajax({
          url: url,
          method: "POST",
          data: {
            view: view
          },
          dataType: "json",
          success: function(data) {
            $('#submenu').html(data.notification);
            if (data.unseen_notification > 0) {
              $('.count').html(data.unseen_notification);
            }
          }
        });
      }

      load_unseen_notification();

      $(document).on('click', '.dropdown-toggle', function() {
        $('.count').html('');
        load_unseen_notification('yes');
      });

      setInterval(function() {
        load_unseen_notification();
      }, 5000);

    });
  </script>
</body>

</html>
