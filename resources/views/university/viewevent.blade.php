<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="text-align: center;">
                <div class="p-6 text-gray-900">
                    <h1 style="font-size: 24px">{{ __("View Event") }}
                    </h1><br><br>

                    <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Name
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Niche
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Location
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Capacity
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($events as $event)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">{{$event->name}}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-500">{{$event->niche}}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-500">{{$event->location}}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{$event->capacity}}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                <a href="{{ route('event.showedit', $event->id) }}" class="text-indigo-600 hover:text-indigo-900 pr-5">Edit</a>
                <a href="{{ route('event.delete', $event->id) }}" class="text-red-600 hover:text-red-900">Delete</a>
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