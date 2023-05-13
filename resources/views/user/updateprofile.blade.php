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
                  <h1 style="font-size: 24px">{{ __("Edit Profile Information") }}
</h1><br><br>
<form action="{{route('attendee.update')}}" method="post">
        @csrf
            <label for="firstname">First Name</label><br>
            <input type="text" id="firstname" name="firstname" value="{{$attendee->firstname}}"><br><br>
            <label for="lastname">Last Name</label><br>
            <input type="text" id="lastname" name="lastname" value="{{$attendee->lastname}}"><br><br>
            <label for="contact">Contact Number</label><br>
            <input type="text" id="contact" name="contact" value="{{$attendee->contact}}"><br><br>
            <label for="uniname">Institute</label><br>
            <input type="text" id="uniname" name="uniname" value="{{$attendee->uniname}}"><br><br>

            <br><br>
         
        <input type="submit" value="Save info" style="background-color: blue; padding:05px; color:white">
    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
