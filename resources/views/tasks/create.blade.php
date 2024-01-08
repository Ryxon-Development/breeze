<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 white:text-gray-200 leading-tight">
            {{ __('New task') }}
        </h2>
    </x-slot>

    <x-slot name="submenu">
        <x-submenu.tasks></x-submenu.tasks>
    </x-slot>

    <div id="content">
{{--        Create a new task form--}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white white:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white white:bg-gray-800 border-b border-gray-200">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="text-xl text-gray-600 white:text-gray-200">{{ __('Name') }}</label><br>
                            <input required type="text" class="border-2 border-gray-300 p-2 w-full" name="name" id="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="text-xl text-gray-600 white:text-gray-200">{{ __('Description') }}</label><br>
                            <textarea required class="border-2 border-gray-500 w-full" name="description" id="description" cols="30" rows="2">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="text-xl text-gray-600 white:text-gray-200">{{ __('Status') }}</label><br>
                            <select name="status" id="status" class="border-2 border-gray-500 w-full">
                                @foreach($taskStatuses as $taskStatus)
                                    <option value="{{ $taskStatus->id }}" {{ old('status') == $taskStatus->id ? 'selected' : '' }}>
                                        {{ __($taskStatus->label) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="text-xl text-gray-600 white:text-gray-200">{{ __('Priority') }}</label><br>
                            <select name="priority" id="priority" class="border-2 border-gray-500 w-full">
                                @foreach($taskPriorities as $taskPriority)
                                    <option value="{{ $taskPriority->id }}" {{ old('priority') == $taskPriority->id ? 'selected' : '' }}>
                                        {{ __($taskPriority->label) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('priority')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="text-xl text-gray-600 white:text-gray-200">{{ __('Assigned to') }}</label><br>
                            <select name="user_id" id="user" class="border-2 border-gray-300 p-2 w-full">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="text-xl text-gray-600 white:text-gray-200">{{ __('Comments') }}</label><br>
                            <textarea class="border-2 border-gray-500 w-full" name="comments" id="comments" cols="30" rows="2">{{ old('comments') }}</textarea>
                            @error('comments')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="text-xl text-gray-600 white:text-gray-200">{{ __('Tags') }}</label><br>
                            <input type="text" class="border-2 border-gray-300 p-2 w-full" name="tags" id="tags" value="{{ old('tags') }}">
                            @error('tags')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="text-xl text-gray-600 white:text-gray-200">{{ __('Dependencies (Ctrl+Click to select multiple)') }}</label><br>
                            <select name="dependencies[]" id="dependencies" multiple class="border-2 border-gray-500 w-full">
                                <!-- Populate with tasks for dependencies, adjust as needed -->
                                @foreach($tasks as $task)
                                    <option value="{{ $task->id }}" {{ in_array($task->id, old('dependencies', [])) ? 'selected' : '' }}>
                                        {{ $task->id.' - '.$task->name.' - ['.$task->user->name.']' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dependencies')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="text-xl text-gray-600 white:text-gray-200">{{ __('Attachments') }}</label><br>

                            <!-- Input for uploading a new file -->
                            <input type="file" name="attachment_file" id="attachment_file" class="border-2 border-gray-300 p-2 w-full">
                            @error('attachment_file')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror

                            <!-- Display existing attachments -->
                            @if (isset($existingAttachments))
                                <div class="mt-2">
                                    <strong>{{ __('Existing Attachments:') }}</strong>
                                    <ul>
                                        @foreach ($existingAttachments as $attachment)
                                            <li>{{ $attachment->file_name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">{{ __('Create task') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
