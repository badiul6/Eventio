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
                        <h2 style="text-align: center; font-size: medium; font-weight: bold;">Socitey Name</h2>
                        <p style="text-align: center; border-radius: 4px; padding: 5px; ">{{ __("$society->name") }}</p>
                        <h2 style="text-align: center; font-size: medium; font-weight: bold;">Affiliated University</h2>
                        <p style="text-align: center; border-radius: 4px; padding: 5px; ">{{$society->uniname}}</p>
                        <h2 style="text-align: center; font-size: medium; font-weight: bold;">Society Email</h2>
                        <p style="text-align: center; border-radius: 4px; padding: 5px; ">{{$society->email}}</p>
                        <h2 style="text-align: center; font-size: medium; font-weight: bold;">Society Type</h2>
                        <p style="text-align: center; border-radius: 4px; padding: 5px; ">{{$society->type}}</p>

                    </div>
                    <div style="flex-basis: 1; ">
                        <h1 style="font-size: x-large; text-align: center;">Actions</h1>
                        <form action="{{route('society.update')}}" method="get">
                            @csrf
                            <input type="submit" value="Update Society info" style="width: 100%; background-color: #4CAF50; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 4px;">
                        </form>
                        <br><br>
                        <form action="{{route('society.delete')}}" method="get">
                            @csrf
                            <input type="submit" value="Delete Society Account" style="width: 100%; background-color: #4CAF50; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 4px;">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>