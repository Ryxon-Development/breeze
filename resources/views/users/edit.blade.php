<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 white:text-gray-200 leading-tight">
            {{ __('Edit user') }}
        </h2>
    </x-slot>

    <x-slot name="submenu">
        <x-submenu.users></x-submenu.users>
    </x-slot>

    <div id="content">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex flex-col">
                <label for="name" class="leading-loose">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="border border-gray-300 p-2 rounded-lg mb-2">
            </div>
            <div class="flex flex-col">
                <label for="email" class="leading-loose">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="border border-gray-300 p-2 rounded-lg mb-2">
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
{{--                        <option value="{{ $role->id }}" @if($user->roles()->get()->pluck('id')->contains($role->id)) selected @endif>{{ $role->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="flex flex-col">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mt-2">{{ __('Save') }}</button>
            </div>
        </form>
    </div>

    <div class="p-4 sm:p-8 bg-white white:bg-gray-800 shadow sm:rounded-lg my-8">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900 white:text-gray-100">
                    {{ __('Personal API Token') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 white:text-gray-400">
                    {{ __("Generate your personal API token.") }}
                </p>
            </header>

            <form id="generate-token-form" method="post" action="{{ route('generate-token', $user) }}" class="mt-6 space-y-6">
                @csrf
                @method('put')
                <div class="flex items-center space-x-4">
                    <input id="api-token-input" type="text" name="api_token" value="{{ $user->api_token }}" class="w-full pr-8">
                    <button type="button" id="copy-token-button" class="p-2 bg-blue-500 text-white rounded">Copy</button>
                </div>
                <x-primary-button>{{ __('Generate') }}</x-primary-button>
            </form>
        </section>
        <script>
            $(document).ready(function() {
                $('#generate-token-form').submit(function(e) {
                    e.preventDefault();

                    // Serialize the form data
                    var formData = $(this).serialize();

                    // Send the AJAX request
                    $.ajax({
                        type: 'PUT',
                        url: $(this).attr('action'),
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            // Update the input field with the new token
                            $('#api-token-input').val(response.token);

                            // Display a success message (you can customize this part)
                            alert('New token generated successfully');
                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
            document.getElementById('copy-token-button').addEventListener('click', function() {
                var apiTokenInput = document.getElementById('api-token-input');
                apiTokenInput.select();
                document.execCommand('copy');
                alert('Token copied to clipboard');
            });
        </script>

    </div>
</x-app-layout>
