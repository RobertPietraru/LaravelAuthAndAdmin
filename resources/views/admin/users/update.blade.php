<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin user page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <div class="w-screen ">

                        <div class="mx-auto p-4">
                            <form method="post" action="{{ route('admin.users.edit', $user) }}" class="mt-6 space-y-6">
                                @csrf
                                @method('patch')
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email', $user->email)"
                                        required autofocus autocomplete="email" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $profile->name)"
                                        required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                        
                                <div>
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $profile->phone)"
                                        required />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>
                        
                                <div>
                                    <x-input-label for="address" :value="__('Address')" />
                                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $profile->address)"
                                        required />
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>
                        
                                <div>
                                    <x-input-label for="school" :value="__('School')" />
                                    <x-text-input id="school" name="school" type="text" class="mt-1 block w-full" :value="old('school', $profile->school)"
                                        required />
                                    <x-input-error class="mt-2" :messages="$errors->get('school')" />
                                </div>
                        
                                <div>
                                    <x-input-label for="gender" :value="__('Gender')" />
                                    <select id="gender" name="gender" :value="old('gender', $profile - > gender)">
                                        <option @if (old('gender', $profile->gender) == 'male') selected @endif value="male">Male</option>
                                        <option @if (old('gender', $profile->gender) == 'female') selected @endif value="female">Female</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                                </div>
                        
                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                        
                                    @if (session('status') === 'success')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                        
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
    <div>



</x-app-layout>