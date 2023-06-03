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
<form action="{{route('attendee.store')}}" method="post">
    @csrf
    <h1>Create Attendee profile</h1><br><br>
    <label for="firstname">First Name</label> <br>
    <input type="text" id="firstname" name="firstname">
    <br>
    <label for="lastname">Last Name</label>
    <br>
    <input type="text" id="lastname" name="lastname">
    <br>
    <label for="contact">Contact Number</label>
    <br>
    <input type="text" id="contact" name="contact">
    <br>
    <label for="uniname">Institute</label>
    <br>
    <input type="text" id="uniname" name="uniname" placeholder="--optional field--">
    
    <br><br>

    <input type="submit" value="Submit" style="background-color: darkseagreen; padding: 10px">

</form>

</div>
</x-app-layout>
