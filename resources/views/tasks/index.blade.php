<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 white:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <x-slot name="submenu">
        <x-submenu.tasks></x-submenu.tasks>
    </x-slot>

    <div id="content">
{{--        Show all tasks in a table format with the columns: id, name, description, status, user_id, created_at, updated_at, actions--}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white white:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white white:bg-gray-800 border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">{{ __('ID') }}</th>
                            <th class="px-4 py-2">{{ __('Name') }}</th>
                            <th class="px-4 py-2">{{ __('Status') }}</th>
                            <th class="px-4 py-2">{{ __('Assigned') }}</th>
                            <th class="px-4 py-2">{{ __('Created at') }}</th>
                            <th class="px-4 py-2">{{ __('Updated at') }}</th>
                            <th class="px-4 py-2">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr style="background-color:
                           @if($task->priority === 1)
                                #ccffcc; /* Light Green */
                            @elseif($task->priority === 2)
                                #ffffcc; /* Light Yellow */
                            @elseif($task->priority === 3)
                                #ffcccc; /* Light Red */
                            @else
                                #FFFFFF; /* White or any other default color */
                            @endif">
                                <td class="border px-4 py-2">{{ $task->id }}</td>
                                <td class="border px-4 py-2">{{ $task->name }}</td>
                                <td class="border px-4 py-2">{{ $task->taskStatus->label }}</td>
                                <td class="border px-4 py-2">{{ $task->user->name }}</td>
                                <td class="border px-4 py-2">{{ $task->created_at }}</td>
                                <td class="border px-4 py-2">{{ $task->updated_at }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">{{ __('Edit') }}</a>
                                    <form class="inline" action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this task?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
