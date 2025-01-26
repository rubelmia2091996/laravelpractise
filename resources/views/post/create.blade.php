<style>

</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tag List') }} 
        </h2>
        <span class="ml-5"> <a href="{{ route('tags.create') }}">Create new</a> </span>

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('tags.store') }}" method="post" >
                    @csrf
                        <label for="tittle">Name</label>
                        <input type="text" id="tittle" name="tittle" class="py-2" required>
                    <button type="submit" class="pt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
