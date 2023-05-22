<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
<div style="text-align:center; ">
<form action="{{route('university.store')}}" method="post">
    @csrf
    <h1 class="uni">Create University profile</h1><br><br>
    <label for="uniname">University Name</label> <br>
    <input type="text" id="uniname" name="uniname">
    <br>
    <label for="contact">Contact No</label>
    <br>
    <input type="text" id="contact" name="contact">
    <br>
    <label for="adress">Address</label>
    <br>
    <input type="text" id="address" name="address">    
    <br><br>

    <input type="submit" value="Submit" style="background-color: darkseagreen; padding: 10px">

</form>

</div>
</x-app-layout>
