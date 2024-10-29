@vite('resources/css/app.css')

<div class="flex flex-col p-12 justify-center items-center h-24" x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
    <div class="text-6xl font-bold" x-text="state"></div>
    <div class="text-xl text-gray-500">MJ/ha</div>
</div>
