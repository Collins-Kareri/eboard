<!--Single task container-->
<div class="flex w-full py-4 border-opacity-30 px-4 h-fit text-sm mb-4 gap-10 task-container task-container-theme">
    {{-- Task details --}}
    <section class="w-full flex h-fit gap-6 items-center">

        {{-- task information container --}}
        <section class="flex flex-col h-fit w-full items-start gap-1">
            {{-- task deadline --}}
            <span class="capitalize font-extralight">due date: @{{task.deadline}}</span>
            {{-- task description --}}
            <p class="flex-1 description-theme">
                <span class="description"
                    :class="[task.status === 'completed' ? 'task-done' : '']">@{{task.description}}</span>
            </p>
            {{-- start_time and end_time --}}
            <p class="font-extralight flex gap-1 items-center text-xs">
                <i class="fa-solid fa-clock-rotate-left opacity-10"></i>
                <span>@{{task.start_time}}</span> - <span>@{{task.end_time}}</span>
            </p>
        </section>
    </section>

    {{-- Task toggle, edit and delete actions --}}
    <div class="flex flex-col justify-between relative items-end">
        {{-- checkbox to mark the tasks as complete --}}
        <input type="checkbox"
            class="appearance-none cursor-pointer p-2 rounded-full h-fit toggle-task-status-theme toggle-task-status"
            :checked="task.status === 'completed'" />
        {{-- Delete and edit task action icons --}}
        <section class="relative flex w-fit gap-x-4 h-fit task-actions-theme">
            <span title="edit task">
                <i class="fa-solid fa-pen fa-lg cursor-pointer h-fit opacity-80 hover:opacity-100"></i>
            </span>

            <span title="delete task">
                <i class="fa-solid fa-trash-can fa-lg cursor-pointer opacity-80 hover:opacity-100"></i>
            </span>
        </section>
    </div>
</div>

<x-splade-script>
    let taskToggleEl=document.querySelectorAll('.toggle-task-status');

    for(let el of taskToggleEl){
    el.addEventListener('click',(evt)=>{
    let clickedEl=evt.target,
    parentEl=clickedEl.closest('.task-container'),
    descriptionEl=parentEl.querySelector('.description');

    if(evt.target.checked){
    descriptionEl.classList.add("task-done");
    }else{
    descriptionEl.classList.remove("task-done");
    }
    });
    }
</x-splade-script>