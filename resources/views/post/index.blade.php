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
            {{ __('Post List') }} 
        </h2>
        <span class="ml-5"> <a href="{{ route('posts.create') }}">Create new</a> </span>

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Sl</td>
                            <td>Thumbnail</td>
                            <td>Title</td>
                            <td>Slug</td>
                            <td>Description</td>
                            <td>Tags</td>
                            <td>Category</td>
                            <td>User</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                     <tbody>
                        @foreach ($posts as $key=>$post)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> <img src="{{ Storage::url($post->thumbnail) }}" alt="" height="100" width="100"> </td>
                            <td>{{ $post->tittle }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->description }}</td>
                            <td>
                                @foreach ($post->tag as $item)
                                {{ $item->tittle }}
                                @endforeach
                            </td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->user_id }}</td>
                            <td>
                                {{-- <a href="{{ route('tags.show', $tag->id ) }}">Show</a> --}}
                                <a href="{{ route('posts.edit', $post->id ) }}">Edit</a>
                                <form action="{{ route('posts.destroy', $post ) }}" method="post">
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
