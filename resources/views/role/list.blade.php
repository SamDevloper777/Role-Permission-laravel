<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{route('roles.create')}}" class="bg-slate-500 px-3 py-2 rounded text-white">create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>




            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Permission</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Created</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $rol )

                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-800">{{$rol->id}}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{$rol->name}}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{$rol->permissions->pluck('name')->implode(',')}}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{\Carbon\Carbon::parse($rol->created_at)->format('d M Y')}}</td>
                                <td class="px-4 flex gap-4 py-2 text-sm text-gray-800">
                                    <a href="{{route('roles.edit',$rol->id)}}" class="bg-green-400 rounded px-3 py-2 text-white">Edit</a>

                                    <form action="{{route('roles.destroy' ,$rol->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <input class="bg-red-400 rounded px-3 py-2 text-white" type="submit" value="Delete">
                                    </form>
                                </td>

                            </tr>
                            @endforeach


                        </tbody>
                    </table>

                    <div class="mt-5">
                        {{$roles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>