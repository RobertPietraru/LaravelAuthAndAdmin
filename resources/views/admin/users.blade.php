<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <div class="p-6 text-gray-900">
                        {{ __("You're the admin!!!!") }}
                    </div>
                    <div class="w-screen ">

                        <div class="mx-auto p-4">
                            <form action="{{ route('admin.users.create') }}"
                                method="POST" class="flex justify-end ">
                                @csrf
                                @method('GET')
                                <button type="submit" class="px-4 py-2 leading-none text-white bg-red-500 hover:bg-red-600 rounded">Create</button>
                            </form>
                            <table class="min-w-full bg-white border border-gray-200 mx-auto">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 bg-gray-100 font-semibold text-gray-700">Id</th>
                                        <th class="py-2 px-4 bg-gray-100 font-semibold text-gray-700">Email</th>
                                        <th class="py-2 px-4 bg-gray-100 font-semibold text-gray-700">Phone</th>
                                        <th class="py-2 px-4 bg-gray-100 font-semibold text-gray-700">Name</th>
                                        <th class="py-2 px-4 bg-gray-100 font-semibold text-gray-700">School</th>
                                        <th class="py-2 px-4 bg-gray-100 font-semibold text-gray-700">Address</th>
                                        <th class="py-2 px-4 bg-gray-100 font-semibold text-gray-700">Gender</th>
                                        <th class="py-2 px-4 bg-gray-100 font-semibold text-gray-700"></th>
                                        <th class="py-2 px-4 bg-gray-100 font-semibold text-gray-700"></th>
                                        <!-- Add more columns if needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $user->id }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $user->email }}</td>
                                            @if ($user->profile)
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    {{ $user->profile->phone }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    {{ $user->profile->name }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    {{ $user->profile->school }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    {{ $user->profile->address }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    {{ $user->profile->gender }}</td>
                                            @else
                                                <td class="py-2 px-4 border-b border-gray-200">-</td>
                                                <td class="py-2 px-4 border-b border-gray-200">-</td>
                                                <td class="py-2 px-4 border-b border-gray-200">-</td>
                                                <td class="py-2 px-4 border-b border-gray-200">-</td>
                                                <td class="py-2 px-4 border-b border-gray-200">-</td>
                                            @endif
                                            <td class="py-2 px-4 border-b border-gray-200">

                                                <form action="{{ route('admin.users.update', $user->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('GET')
                                                    <button type="submit" class="px-4 py-2 leading-none text-white bg-red-500 hover:bg-red-600 rounded">Update</button>
                                                </form>

                                            </td>

                                            @if ($admin->id != $user->id)
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    <form action="{{ route('admin.users.delete', $user->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-4 py-2 leading-none text-white bg-red-500 hover:bg-red-600 rounded">Delete</button>
                                                    </form>

                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
    <div>



</x-app-layout>
