<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 white:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <x-slot name="submenu">
        <x-submenu.users></x-submenu.users>
    </x-slot>

    <div id="content">
{{--        Show all users in table format with edit and delete buttons from fontawesome...--}}
        <table class="table-auto w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">{{ __('Name') }}</th>
                <th class="px-4 py-2">{{ __('Email') }}</th>
{{--                <th class="px-4 py-2">{{ __('Roles') }}</th>--}}
                <th class="px-4 py-2">{{ __('Actions') }}</th>
                <th class="px-4 py-2">{{ __('API') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="bg-gray-100">
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
{{--                    <td class="border px-4 py-2">{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>--}}
                    <td class="border px-4 py-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="text-gray-500 hover:text-gray-700 white:text-gray-400 white:hover:text-gray-300">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('Are you sure you want to delete this user?') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-gray-700 white:text-gray-400 white:hover:text-gray-300">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                    <td class="border px-4 py-2">
                        {!! $user->api_token ? '<i class="fas fa-check text-green-500"></i>' : '' !!}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

{{--        <div id="example"></div>--}}

{{--        <div class="example"></div>--}}
{{--        <div class="example"></div>--}}

        <div id="another" data-count="2" data-title="Some title..." data-users="{{ $users }}"></div>

    </div>
</x-app-layout>
