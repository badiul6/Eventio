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
                {{ __("$uni->uniname") }}
                    <br>
<br><br>
<h2>Email ID:</h2>
                    <p>{{$uni->email}}</p><br>
                    <h2>Contact Number:</h2>
                    <p>{{$uni->contact}}</p><br>
                    <h2>Address:</h2>
                    <p>{{$uni->address}}</p>

</div>
<div style="flex-basis: 1; ">
    <form action="{{route('university.update')}}" method="get">
        @csrf
        <input type="submit" value="Update University info" style="background-color: blue; padding:05px; color:white">
    </form>
    <br><br>
    <form action="{{route('university.delete')}}" method="get">
        @csrf
        <input type="submit" value="Delete University Account" style="background-color: blue; padding:05px; color:white">
    </form>
    <br><br>
    <form action="{{route('university.cevent')}}" method="get">
        @csrf
        <input type="submit" value="Create Event" style="background-color: blue; padding:05px; color:white">
    </form>
    <form action="/university/viewevent" method="get">
        @csrf
        <input type="submit" value="View Event" style="background-color: blue; margin-top:5px; padding:05px; color:white">
    </form>


</div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
