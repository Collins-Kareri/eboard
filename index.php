<?php
include "./partials/head.php";
?>

<?php
include "./Calender.php";

use Calender\Calender;
use Carbon\Carbon;

$current_month = Calender::buildMonth();
$year = $current_month['year'];
$month = $current_month['month'];
$dates = $current_month['dates'];
$days_initials = ['m', 't', 'w', 't', 'f', 's', 's'];

/**
 * function to determine which corners on calender will be rounded
 */
function round_corner($index)
{
    switch ($index) {
        case 1:
            return "rounded-tl-lg";
        case 7:
            return "rounded-tr-lg";
        case 36:
            return "rounded-bl-lg";
        case 42:
            return "rounded-br-lg";
        default:
            return "";
    }
}
?>

<div class="flex lg:flex-row flex-col w-full gap-10 before:content-[''] before:border before:border-slate-200 before:border-opacity-40 before:self-stretch">
    <!-- calender container -->
    <section class="flex-1 mb-6 lg:mb-0 lg:px-4 -order-1">
        <div class="inline-flex items-center justify-between w-full mb-5 text-sm">
            <h1 class="font-light"><?= "{$month} {$year}" ?></h1>
            <div class="inline-flex h-fit items-center gap-2 text-slate-700 opacity-90">
                <span class="bg-slate-800 px-3 py-1 rounded border border-slate-200 cursor-pointer">
                    <i class="fa-solid fa-backward-step fa-lg"></i>
                </span>
                <span class="capitalize font-light mx-1 cursor-pointer">today</span>
                <span class="bg-slate-800 px-3 py-1 rounded border border-slate-200 cursor-pointer">
                    <i class="fa-solid fa-forward-step fa-lg"></i>
                </span>
            </div>
        </div>

        <div class="grid grid-cols-7">
            <!-- loop through days in letters display that is monday to sunday -->
            <?php foreach ($days_initials as $day_initial) : ?>
                <!-- day letter container -->
                <span class="inline-block text-center uppercase mb-1 font-extralight">
                    <?= $day_initial ?>
                </span>
            <?php endforeach; ?>

            <!-- index of the current date in the loop we start from 1 all the way to 42 as the array has 42 dates. Used to determine which corners to round -->
            <?php $current_date_index = 1; ?>

            <!-- loop through dates display in in the dates array-->
            <?php foreach ($dates as $date_instance) : ?>
                <!-- date container with different styling for dates not in the current month -->
                <span class='text-sm inline-block text-center border px-3 py-2  border-slate-100  <?= $date_instance['within_month'] ? "cursor-pointer bg-slate-900" : "font-extralight cursor-not-allowed bg-slate-800" ?> <?= round_corner($current_date_index) ?>'>
                    <p class=' w-9 h-9 mx-auto px-2 py-2 rounded-full <?= $date_instance['within_month'] ? "cursor-pointer hover:bg-cyan-50 hover:text-cyan-900" : "font-extralight cursor-not-allowed" ?> <?= $date_instance['is_today'] ? "bg-cyan-50 text-cyan-900 " : "" ?>'>
                        <?= $date_instance['day_number'] ?>
                    </p>
                </span>
                <!-- increase current date index by one. -->
                <?php $current_date_index++; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Tasks container -->
    <section class="flex-1 lg:px-4">
        <div class="inline-flex items-center justify-between flex-wrap w-full pb-6 mb-2">
            <h1>Schedule for <?= $month ?> <?= Carbon::now()->format('d') ?>, <?= $year ?> </h1>
            <button class=" text-sm flex w-fit shrink-0 items-center px-4 py-3 bg-slate-800 ring-2 ring-slate-800 rounded gap-2 capitalize">
                add task
            </button>
        </div>


        <section class="flex items-start flex-wrap w-full px-4 flex-row h-[450px] overflow-auto scroll_container">
            <!--Single task container-->
            <!-- <div class="flex w-fit flex-row py-4 border-opacity-30 px-4 h-fit bg-slate-800 rounded text-sm mb-4 shadow-inner shadow-slate-200">
                Task details
                <section class="w-full flex h-fit gap-x-4">
                    <input type="checkbox" name="task_toggle" id="task_toggle" class="cursor-pointer rounded p-2 bg-slate-900 border-slate-900" />
                    <section class="flex flex-col h-fit">
                        <p class="font-extralight">7:00a.m - 8:00a.m</p>
                        <p class="font-light">
                            Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry.
                        </p>
                    </section>
                </section>

                Delete and edit task 
                <section class="relative flex w-full justify-end gap-x-4 h-full">
                    <span>
                        <i class="fa-solid fa-pen-to-square fa-lg cursor-pointer h-fit opacity-80 hover:opacity-100"></i>
                    </span>

                    <span>
                        <i class="fa-solid fa-trash fa-lg cursor-pointer opacity-80 hover:opacity-100"></i>
                    </span>
                </section>
            </div> -->

            <!--Placeholder content-->
            <p class="w-full text-center font-light">
                No tasks. You're all caught up.
            </p>
        </section>
    </section>
</div>

<?php
include "./partials/footer.php"
?>