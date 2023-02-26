<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="index.css" />
    <script src="https://kit.fontawesome.com/cf619e81e7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>Employees</title>
</head>

<body class="bg-black h-screen overflow-hidden flex transition-all ease-linear duration-300">
    <!--siderbar-->
    <header class="relative inline-block h-screen bg-slate-900 p-6 min-w-[300px] scroll_container overflow-y-auto text-slate-700">
        <!--title of the siderbar-->
        <section class="mb-1 py-4 inline-flex items-center justify-between w-full">
            <a href="#" class="text-2xl capitalize">LOGO</a>
            <span class="py-1 px-2 rounded hover:bg-slate-800 cursor-pointer">
                <i class="fa-solid fa-bell cursor-pointer"></i>
            </span>
        </section>

        <!--user profile info and logout button-->
        <section class="flex flex-row justify-between items-center border-t border-slate-200 py-4 border-opacity-30 mb-2 opacity-80">
            <!--profile picture and employee position-->
            <div class="h-fit flex flex-col items-center">
                <span class="bg-slate-800 w-fit px-4 py-3 text-center rounded-full block">
                    <i class="fa-solid fa-skull fa-lg"></i>
                </span>
                <p class="font-light capitalize">name</p>
                <p class="text-sm font-extralight">position</p>
            </div>

            <a href="#" class="group text-sm flex w-fit shrink-0 items-center px-4 py-3 bg-slate-800 ring-2 ring-slate-800 rounded gap-2 capitalize">
                <p>log out</p>
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        </section>

        <!--navigation links-->
        <!--active bg-slate-600 text-slate-700 -->
        <!--inactive bg-slate-600 text-slate-700 -->
        <section class="flex flex-col w-full justify-between items-start text-slate-600 border-t border-slate-200 py-4 border-opacity-30 gap-4 capitalize mb-2">
            <a href="#" class="group flex w-fit shrink-0 items-center w-full hover:text-slate-700 gap-2 hover:bg-slate-600 rounded-md p-2">
                <i class="fa-solid fa-house-user"></i>
                <p>home</p>
            </a>
            <a href="#" class="group flex w-fit shrink-0 items-center w-full hover:text-slate-700 gap-2 p-2 hover:bg-slate-600 rounded-md">
                <i class="fa-solid fa-people-group"></i>
                <p>employees</p>
            </a>

            <a href="#" class="group flex w-fit shrink-0 items-center w-full hover:text-slate-700 gap-2 p-2 hover:bg-slate-600 rounded-md bg-slate-600 text-slate-700">
                <i class="fa-solid fa-calendar-check"></i>
                <p>tasks</p>
            </a>
            <a href="#" class="group flex w-fit shrink-0 items-center w-full hover:text-slate-700 gap-2 p-2 hover:bg-slate-600 rounded-md">
                <i class="fa-solid fa-gear"></i>
                <p>account settings</p>
            </a>
        </section>

        <!--invite employee or add admin-->
        <section class="flex flex-col w-full justify-between items-start text-slate-600 border-t border-slate-200 py-4 border-opacity-30 gap-4 capitalize mb-2">
            <a href="#" class="group flex w-fit shrink-0 items-center w-full hover:text-slate-700 gap-2 p-2 hover:bg-slate-600 rounded-md">
                <i class="fa-solid fa-paper-plane"></i>
                <p>invite employee</p>
            </a>
            <a href="#" class="group flex w-fit shrink-0 items-center w-full hover:text-slate-700 gap-2 p-2 hover:bg-slate-600 rounded-md">
                <i class="fa-solid fa-person-circle-plus"></i>
                <p>add admin</p>
            </a>
        </section>
    </header>


    <!--body for dashboard-->
    <main class="relative w-full mx-auto h-screen overflow-y-auto scroll_container w-full px-10 py-4 text-slate-700">