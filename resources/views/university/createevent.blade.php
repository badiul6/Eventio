<x-app-layout>
    <x-slot name="header">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                        <label for="name">Name:</label><br>
                        <input type="text" id="name" name="name"><br><br>

                        <label for="niche">Niche:</label><br>
                        <input type="text" id="niche" name="niche"><br><br>

                        <label for="location">Location:</label><br>
                        <input type="text" id="location" name="location"><br><br>

                        <label for="capacity">Capacity:</label><br>
                        <input type="number" id="capacity" name="capacity"><br><br>

                        <label for="date">Date:</label><br>
                        <input type="date" id="date" name="date" required><br><br>

                        <label for="time1">Start Time:</label><br>
                        <input type="time" id="start_time" name="start_time" min="08:00" max="18:00" required><br><br>

                        <label for="time2">End Time:</label><br>
                        <input type="time" id="end_time" name="end_time" min="08:00" max="18:00" required><br><br>
                </div>
                <button type="submit" style="background-color: blue; padding:05px; color:white">Create Event</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#dropdownCheckboxButton').click(function(e) {
                e.stopPropagation();
                $('#dropdownDefaultCheckbox').toggleClass('hidden');
            });

            // $(document).click(function() {
            //     $('#dropdownDefaultCheckbox').addClass('hidden');
            // });
        });
    </script>

</x-app-layout>