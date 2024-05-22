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
{{--        button to invoke the 'revoke-token' route.--}}
    <button id="revoke-token-button" type="button" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
    {{ __('Revoke') }}
    </button>
    </form>
    <form id="revoke-token-form" method="post" action="{{ route('revoke-token', $user) }}" class="hidden">
        @csrf
        @method('delete')
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

    // New code for revoking token
    $('#revoke-token-button').click(function(e) {
        e.preventDefault();

        // Send the AJAX request
        $.ajax({
            type: 'DELETE',
            url: $('#revoke-token-form').attr('action'),
            data: $('#revoke-token-form').serialize(),
            dataType: 'json',
            success: function(response) {
                // Clear the input field and display a success message
                $('#api-token-input').val('');
                alert('Token revoked successfully');
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
