<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-Poppins bg-gradient-to-t from-fbc2eb to-a6c1ee h-screen">
    <header class="bg-gray-900">
        <nav class="flex justify-end items-center w-92 h-5 ">
            <!-- <div
                class="nav-links duration-500 md:static absolute bg-gray-900 md:min-h-fit min-h-60vh left-0 top-[-100%] md:w-auto w-full flex items-center px-5">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-4vw gap-8">
                    <li>
                        <a class="hover:text-gray-500 text-white" href="#">Products</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-500 text-white" href="#">Solution</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-500 text-white" href="#">Resource</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-500 text-white" href="#">Developers</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-500 text-white" href="#">Pricing</a>
                    </li>
                </ul>
            </div> -->
            <div class="px-4 relative">
                <button id="dropdownButton" class="relative z-10">
                    <i class="bi bi-bell-fill"></i>
                </button>
                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 bg-white rounded-md shadow-lg w-fit">
                    <!-- Dropdown menu items -->
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Option 1 test message fkashfaskdjgfaskjdgsadfkashdfgaskjgfaskdfhgaskdjfgfasdfasdfasdfadfasfasdfasdf</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Option 2</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Option 3</a>
                </div>
            </div>
            <div class="relative">
                <input type="checkbox" name="menu" class="hidden" id="showlinknav" checked>
                <label for="showlinknav" class="cursor-pointer p-2" id="open_menu" onclick="navshowlink();">
                    <?= $userInfo['name']; ?>! <i class="text-sm bi bi-chevron-down"></i>
                </label>
                <ul class="absolute border-2 hidden mt-2 right-0 bg-white rounded-lg shadow-lg p-2 w-40 transition-opacity duration-300 opacity-0"
                    id="dropdown_menu">
                    <li><a href="#" class="block px-4 py-3 text-lg text-gray-800 hover:bg-gray-200"><i
                                class="bi bi-person"></i> Profile</a></li>
                    <li><a href="<?= site_url('logout'); ?>"
                            class="block px-4 py-3 text-lg text-gray-800 hover:bg-gray-200"><i
                                class="bi bi-box-arrow-in-right"></i> Logout</a></li>
                    <span class="absolute bg-white h-2 w-2 transform rotate-45 top-0 right-2 -mt-1"></span>
                </ul>
            </div>
            <!-- <div class="flex items-center gap-6">
                <a href="<?= site_url('logout'); ?>"
                    class="bg-a6c1ee text-white px-5 py-2 rounded-full hover:bg-87acec justify-end"><i
                        class="bi bi-box-arrow-in-right"></i> Log-out</a>
                <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
            </div> -->
        </nav>
    </header>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const openMenu = document.getElementById("open_menu");
            const dropdownMenu = document.getElementById("dropdown_menu");

            openMenu.addEventListener("mouseenter", function () {
                dropdownMenu.classList.remove("hidden");
                dropdownMenu.classList.add("opacity-100");
            });

            openMenu.addEventListener("mouseleave", function () {
                setTimeout(function () {
                    if (!dropdownMenu.matches(':hover')) {
                        dropdownMenu.classList.remove("opacity-100");
                        dropdownMenu.classList.add("opacity-0");
                        setTimeout(function () {
                            dropdownMenu.classList.add("hidden");
                        }, 300);
                    }
                }, 100);
            });

            dropdownMenu.addEventListener("mouseleave", function () {
                setTimeout(function () {
                    if (!openMenu.matches(':hover') && !dropdownMenu.matches(':hover')) {
                        dropdownMenu.classList.remove("opacity-100");
                        dropdownMenu.classList.add("opacity-0");
                        setTimeout(function () {
                            dropdownMenu.classList.add("hidden");
                        }, 300);
                    }
                }, 100);
            });

            dropdownMenu.style.width = "10rem"; // Adjust the width as needed
        });

        document.getElementById('dropdownButton').addEventListener('click', function () {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        });

        // Close the dropdown menu if clicked outside
        window.addEventListener('click', function (event) {
            var dropdownButton = document.getElementById('dropdownButton');
            var dropdownMenu = document.getElementById('dropdownMenu');

            if (!dropdownButton.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>