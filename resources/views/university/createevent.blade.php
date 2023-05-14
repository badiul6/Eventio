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
                    <h1 style="font-size: 24px">{{ __("Create Event") }}
                    </h1><br><br>
                    <form method="POST" action="{{route('event.create')}}">
                        @csrf
                            <label for="society_email">Society Email:</label><br>
                            <input type="text" id="society_email" name="society_email"><br><br>

                            <label for="name">Name:</label><br>
                            <input type="text" id="name" name="name"><br><br>
                            
                            <label for="niche">Niche:</label><br>
                            <input type="text" id="niche" name="niche"><br><br>
                            
                            <label for="location">Location:</label><br>
                            <input type="text" id="location" name="location"><br><br>
                            
                            <label for="capacity">Capacity:</label><br>
                            <input type="number" id="capacity" name="capacity"><br><br>
                        </div>
                        <button type="submit" style="background-color: blue; padding:05px; color:white">Create Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>