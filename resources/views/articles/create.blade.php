<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Articles/create
            </h2>
            <a href="{{route('articles.index')}}" class="bg-slate-500 px-3 py-2 rounded text-white">back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('articles.store')}}" method="post">
                        @csrf
                        <div>
                            <label for="" class="text-sm font-medium">Title</label>
                            <div>
                                <input type="text" class="border-gray-300 shadow-sm w-1/2 rounded" name="title" placeholder="Enter title">
                                @error('title')
                                    <p class="text-red-500 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                            <label for="" class="text-sm font-medium">Content</label>
                            <div>
                                <textarea rows="6" type="text" class="border-gray-300 shadow-sm w-1/2 rounded" name="text" placeholder="Enter Content"></textarea>
                               
                            </div>

                            <label for="" class="text-sm font-medium">Author</label>
                            <div>
                                <input type="text" class="border-gray-300 shadow-sm w-1/2 rounded" name="author" placeholder="Author">
                                @error('author')
                                    <p class="text-red-500 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                            <input type="submit" class="bg-blue-600 mt-2 text-white py-2 px-3 rounded">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
