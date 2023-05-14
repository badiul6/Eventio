<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display: flex; flex: row unwrap">
                <div style="margin-right:800px">
                {{ __("Welcome $attendee->firstname $attendee->lastname ") }}
                    <br>
<br><br>
<h2>Email ID:</h2>
                    <p>{{$attendee->email}}</p><br>
                    <h2>Contact Number:</h2>
                    <p>{{$attendee->contact}}</p><br>
                    <h2>Institute:</h2>
                    <p>{{$attendee->uniname}}</p>

</div>
<div style="flex-basis: 1; ">
    <form action="{{route('attendee.update')}}" method="get">
        @csrf
        <input type="submit" value="Update info" style="background-color: blue; padding:05px; color:white">
    </form>
    <br><br>
    <form action="/user/viewevent" method="get">
        @csrf
        <input type="submit" value="View Events" style="background-color: blue; padding:05px; color:white">
    </form>
    <br><br>
    <form action="/user/viewjoinedevent" method="get">
        @csrf
        <input type="submit" value="Joined Events" style="background-color: blue; padding:05px; color:white">
    </form>
    <br><br>
    <form action="{{route('attendee.delete')}}" method="get">
        @csrf
        <input type="submit" value="Delete Account" style="background-color: blue; padding:05px; color:white">
    </form>

</div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
