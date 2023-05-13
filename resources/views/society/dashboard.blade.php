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
                {{ __("$society->name") }}
                    <br>
<br><br>
<h2>University Name:</h2>
                    <p>{{$society->uniname}}</p><br>
                    <h2>Society Email:</h2>
                    <p>{{$society->email}}</p><br>
                    <h2>Society Type:</h2>
                    <p>{{$society->type}}</p>

</div>
<div style="flex-basis: 1; ">
    <form action="{{route('society.update')}}" method="get">
        @csrf
        <input type="submit" value="Update Society info" style="background-color: blue; padding:05px; color:white">
    </form>
    <br><br>
    <form action="{{route('society.delete')}}" method="get">
        @csrf
        <input type="submit" value="Delete Society Account" style="background-color: blue; padding:05px; color:white">
    </form>

</div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
