<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              User/Edit
            </h2>
            <a href="{{route('users.index') }}" class="bg-slate-500 px-3 py-2 rounded text-white">back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('users.update',$user->id)}}" method="post">
                        @csrf
                 
                        <div>
                            <label for="" class="text-sm font-medium">Name</label>
                            <div>
                                <input type="text" value="{{old('name',$user->name)}}" class="border-gray-300 shadow-sm w-1/2 rounded" name="name" placeholder="Enter Name">
                                @error('name')
                                    <p class="text-red-500 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                            <label for="" class="text-sm font-medium">Email</label>
                            <div>
                                <input type="text" value="{{old('email',$user->email)}}" class="border-gray-300 shadow-sm w-1/2 rounded" name="email" placeholder="Enter email">
                                @error('email')
                                    <p class="text-red-500 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-4 mb-3">
                                
                                    @if($roles->isNotEmpty())
                                    @foreach ($roles as $role )
                                        <div class="mt-3 ">
                                            <input {{($hasRoles->contains($role->id)) ? 'checked' : ''}} type="checkbox" id="{{$role->id}}" class="rounded" name="role[]" value="{{$role->name}}">
                                            <label for="{{$role->id}}">{{$role->name}}</label>
                                        </div>       
                                    @endforeach
                                    @endif
                            
                            </div>
                            <input type="submit" class="bg-blue-600 mt-2 text-white py-2 px-3 rounded">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
