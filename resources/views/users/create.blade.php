<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 white:text-gray-200 leading-tight">
            {{ __('New user') }}
        </h2>
    </x-slot>

    <x-slot name="submenu">
        <x-submenu.users></x-submenu.users>
    </x-slot>

    <div id="content">
{{--        Create a form to create a new user just like the edit form.--}}
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="flex flex-col">
                <label for="name" class="leading-loose">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="border border-gray-300 p-2 rounded-lg mb-2">
            </div>
            <div class="flex flex-col">
                <label for="email" class="leading-loose">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="border border-gray-300 p-2 rounded-lg mb-2">
            </div>
            <div class="flex flex-col">
                <label for="password" class="leading-loose">{{ __('Password') }}</label>
                <input type="password" name="password" id="password" class="border border-gray-300 p-2 rounded-lg mb-2">
            </div>
            <div class="flex flex-col">
                <label for="password_confirmation" class="leading-loose">{{ __('Confirm password') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="border border-gray-300 p-2 rounded-lg mb-2">
            </div>
{{--            <div class="flex flex-col">--}}
{{--                <label for="roles" class="leading-loose">{{ __('Roles') }}</label>--}}
{{--                <select name="roles[]" id="roles" multiple class="border border-gray-300 p-2 rounded-lg mb-2">--}}
{{--                    @foreach($roles as $role)--}}
{{--                        <option value="{{ $role->id }}">{{ $role->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

{{--            </div>--}}
            <div class="flex flex-col">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mt-2">{{ __('Save') }}</button>
            </div>
        </form>

    </div>

</x-app-layout>
