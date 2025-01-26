<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
        <span class="ml-5">
            <a href="{{ route('posts.index') }}" class="text-blue-500 hover:text-blue-700 font-medium">Post List</a>
        </span>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Edit Post</h3>
                <form action="{{ route('posts.update', $post->id) }}" method="post" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title Input -->
                    <div>
                        <label for="tittle" class="block text-sm font-medium text-gray-700">Post Title</label>
                        <input type="text" id="tittle" name="tittle" value="{{ old('tittle', $post->tittle) }}" required
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <!-- Description Input -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" required cols="30" rows="10"
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $post->description) }}</textarea>
                    </div>

                    <!-- Thumbnail Input -->
                    <div>
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail</label>
                        <input type="file" id="thumbnail" name="thumbnail"
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @if ($post->thumbnail)
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="Current Thumbnail" class="mt-4 w-32 h-auto rounded-md">
                            <p class="text-sm text-gray-500">Current Thumbnail</p>
                        @endif
                    </div>

                    <!-- Category Selection -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Select Category</label>
                        <select id="category" name="category"
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tags Selection -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700">Select Tags</label>
                        <select id="tags" name="tags[]" multiple
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" {{ $post->tag->contains($tag->id) ? 'selected' : '' }}>
                                    {{ $tag->tittle }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-sm text-gray-500">Hold down Ctrl (Windows) or Command (Mac) to select
                            multiple options.</p>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-black py-2 px-4 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
