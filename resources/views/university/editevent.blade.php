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
                    <h1 style="font-size: 24px">{{ __("Edit Event") }}
                    </h1><br><br>
                    <form method="POST" action="{{route('event.edit', $event->id)}}">
                        @csrf
                        <label for="name">Name:</label><br>
                        <input type="text" id="name" name="name" value={{$event->name}}><br><br>

                        <label for="niche">Niche:</label><br>
                        <input type="text" id="niche" name="niche" value={{$event->niche}}><br><br>

                        <label for="location">Location:</label><br>
                        <input type="text" id="location" name="location" value={{$event->location}}><br><br>

                        <label for="capacity">Capacity:</label><br>
                        <input type="number" id="capacity" name="capacity" value={{$event->capacity}}><br><br>

                        <label for="date">Date:</label><br>
                        <input type="date" id="date" name="date" required value={{$event->date}}><br><br>

                        <label for="time1">Start Time:</label><br>
                        <input type="time" id="start_time" name="start_time" min="08:00" max="18:00" required value={{$event->start_time}} ><br><br>

                        <label for="time2">End Time:</label><br>
                        <input type="time" id="end_time" name="end_time" min="08:00" max="18:00" required value={{$event->end_time}}><br><br>

                </div>
                <button type="submit" style="background-color: blue; padding:05px; color:white">Edit Event</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>