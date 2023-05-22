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
                        <h2 style="text-align: center; font-size: medium; font-weight: bold;">University Name</h2>
                        <p style="text-align: center; border-radius: 4px; padding: 5px; ">{{ __("$uni->uniname") }}</p><br>
                        <h2 style="text-align: center; font-size: medium; font-weight: bold;">Email ID</h2>
                        <p style="text-align: center; border-radius: 4px; padding: 5px;">{{$uni->email}}</p><br>
                        <h2 style="text-align: center; font-size: medium; font-weight: bold;">Contact Number</h2>
                        <p style="text-align: center; border-radius: 4px; padding: 5px;">{{$uni->contact}}</p><br>
                        <h2 style="text-align: center; font-size: medium; font-weight: bold;">Address</h2>
                        <p style="text-align: center; border-radius: 4px; padding: 5px;">
                            {{$uni->address}}
                        </p>
                    </div>

                    <div style="display: flex; flex-direction: column; flex-basis: 1;">

                        <h1 style="font-size: x-large; text-align: center;">Actions</h1>
                        <form action="{{route('university.update')}}" method="get">
                            @csrf
                            <input type="submit" value="Update University info" style="width: 100%; background-color: #4CAF50; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 4px;">
                        </form>
                        <br><br>
                        <form action="{{route('university.delete')}}" method="get">
                            @csrf
                            <input type="submit" value="Delete University Account" style="width: 100%; background-color: #4CAF50; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 4px;">
                        </form>
                        <br><br>
                        <form action="{{route('university.cevent')}}" method="get">
                            @csrf
                            <input type="submit" value="Create Event" style="width: 100%; background-color: #4CAF50; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 4px;">
                        </form>
                        <form action="/university/viewevent" method="get">
                            @csrf
                            <input type="submit" value="View Event" style="width: 100%; background-color: #4CAF50; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 4px;">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>