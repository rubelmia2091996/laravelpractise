<style>
    table{
        width: 100%;
    }
    table, th, td {
        border: 1px solid;
        
    }
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
                <table class="table">
                    <thead>
                        <tr>
                            <td>Sl</td>
                            <td>Name</td>
                            <td>Slug</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                     <tbody>
                        @foreach ($tags as $key=>$tag)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $tag->tittle }}</td>
                            <td>{{ $tag->slug }}</td>
                            <td>
                                {{-- <a href="{{ route('tags.show', $tag->id ) }}">Show</a> --}}
                                <a href="{{ route('tags.edit', $tag->id ) }}">Edit</a>

                                <form action="{{ route('tags.destroy', $tag ) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                     </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
