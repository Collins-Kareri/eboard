@props(['heading'])

<!--Tasks header-->

<section class="flex items-center justify-between flex-wrap w-full p-5 h-fit rounded task-header-theme">
    <h1 class='capitalize'>{{$heading}}</h1>
    {{-- add a way to display add task form --}}
    <x-button priority='primary' textContent='add task' id='add_task' />
</section>


<x-splade-script>
    let addTaskBtn=document.querySelector('#add_task');
    addTaskBtn.addEventListener('click',()=>{
        return alert('hello');
    })
</x-splade-script>
