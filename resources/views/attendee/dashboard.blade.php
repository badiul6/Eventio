<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    @php
    $user = auth()->user();
    $attendee = $user->attendee;
    $uni = App\Models\University::all();
    @endphp

    @if (is_null(auth()->user()->attendee))
    @include("attendee.createprofile")
    @else
    @include("attendee.updateprofile")
    <div class="flex flex-col bg-[#06141d] h-screen p-3 overflow-auto">

        <div class="pr-12">
            <div class="flex flex-row">
                <img class="h-10 rounded-lg basis-1/12" src={{asset('imgs/logo.svg')}}>

                <div class="flex justify-end w-full basis-11/12 items-center">
                    <div id="profileArea" class="relative">
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-full bg-[#3e4a52]  focus:outline-none">
                            <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/lego/2.jpg">
                            <span class="text-white font-semibold">{{$attendee->first_name . " " . $attendee->last_name}}</span>
                            <svg class="w-4 h-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div id="profileDropDown" class="hidden absolute right-0 mt-2 w-48 bg-[#3e4a52] rounded-md shadow-lg z-10">
                            <a href="#" class="block px-4 py-2 text-white hover:bg-gray-500">Profile</a>
                            <a href="#" class="block px-4 py-2 text-white hover:bg-gray-500">Settings</a>
                            <form action="{{route('logout')}}" class="block px-4 py-2 text-white hover:bg-gray-500" method="post">
                                @csrf
                                <button type="submit" class="text-left w-full" data-modal-toggle="defaultModal">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="flex flex-grow items-center rounded-2xl h-full p-4">

            <!-- Left bar -->
            <div class="flex flex-col basis-3/12 h-full items-center mr-3 space-y-4">

                <!-- Profile -->
                <div class="flex flex-col bg-[#1b2730] mx-5 rounded-2xl w-full h-1/2">
                    <div class="flex flex-col items-center pb-5">
                        <div class="flex flex-col w-full items-center rounded-lg">
                            <img class="h-full bg-gray-100 rounded-t-lg" src="https://timelinecovers.pro/facebook-cover/download/Best-Covers-For-Facebook-Timeline-sunflower.jpg">

                            <img class="h-20 bg-gray-100 rounded-full mt-[-12%] border-[3px] border-white" src="https://randomuser.me/api/portraits/lego/2.jpg">
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <label class="text-gray-100 font-semibold mt-[-15px] text-lg">{{$attendee->first_name . " " . $attendee->last_name}}</label>
                        <label class="text-gray-400 text-sm font-semibold">{{"@" . $user->name}}</label>
                        <label class="text-gray-100 text-sm font-semibold mx-10 text-center mt-2">{{$attendee->bio}}</label>
                        <span class="flex mt-5 border-1 border-[#4f5c66] border-t-2 w-full items-center py-3 justify-center">
                            <a class="m-1/2 h-full w-full text-center text-cyan-600 font-bold" href="#">My Profile</a>
                        </span>
                    </div>
                </div>

                <!-- Recent Events -->

                <div class="flex flex-col bg-[#1b2730] mx-5 rounded-2xl w-full h-1/2 p-2 overflow-y-auto scrollbar-hide">
                    <div class="flex flex-col pb-5">
                        <h2 class="text-gray-100 font-semibold text-lg p-2">Events I Joined</h2>

                        <!-- Joined Event 1 -->
                        <div class="flex flex-row rounded-lg mt-3 w-full p-2">
                            <img class="w-14 h-14 bg-gray-100 rounded-full" src="https://timelinecovers.pro/facebook-cover/download/Best-Covers-For-Facebook-Timeline-sunflower.jpg">

                            <div class="ml-5">
                                <h1 class="text-gray-100 text-sm font-semibold">Event</h1>
                                <h1 class="text-gray-400 text-sm font-semibold">University</h1>
                                <h1 class="text-gray-400 text-sm font-semibold">Attended on 27 Jan, 2023</h1>
                            </div>
                        </div>

                        <!-- Joined Event 1 -->
                        <div class="flex flex-row rounded-lg mt-3 w-full p-2">
                            <img class="w-14 h-14 bg-gray-100 rounded-full" src="https://img-dotcom-media.s3.us-east-2.amazonaws.com/assets/d9d63ede-6b16-11e6-932c-cdbbf8730860.jpg">

                            <div class="ml-5">
                                <h1 class="text-gray-100 text-sm font-semibold">Event 2</h1>
                                <h1 class="text-gray-400 text-sm font-semibold">University</h1>
                                <h1 class="text-gray-400 text-sm font-semibold">Attended on 27 Jan, 2023</h1>
                            </div>
                        </div>

                        <!-- Joined Event 1 -->
                        <div class="flex flex-row rounded-lg mt-3 w-full p-2">
                            <img class="w-14 h-14 bg-gray-100 rounded-full" src="https://happeningandfriends.com/uploads/happening/products/46/004554/mock_ST_newSadCat.jpg">

                            <div class="ml-5">
                                <h1 class="text-gray-100 text-sm font-semibold">Event 3</h1>
                                <h1 class="text-gray-400 text-sm font-semibold">University</h1>
                                <h1 class="text-gray-400 text-sm font-semibold">Attended on 27 Jan, 2023</h1>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Center Bar -->
            <div class="flex flex-col basis-4/5 h-full p-5 rounded-2xl px-10 overflow-scroll">

                <table id="attendee-events" class="flex flex-col rounded-2xl w-full h-1/2">
                    <tr class="flex bg-[#1b2730] opacity-90 rounded-lg px-6 mb-1 h-72 space-x-4">
                        <!-- name, niche, date time, pics -->
                        <td class="flex flex-col basis-3/4 py-2">
                            <span class="text-white text-sm font-semibold">University Presents</span>
                            <span class="text-white text-left text-3xl font-semibold row-start-2">Event Name</span>
                            <span class="text-white font-light row-start-3 text-justify mt-5 mr-20">Welcome to the darkest depths of your desires at "Midnight Masquerade," a seductively sinister soirée that will leave you yearning for more. Step into a shadowy realm where mischief reigns and inhibitions dissolve like mist in the moonlight. Surrender to the allure of forbidden fantasies as enigmatic figures dance through the haze, their masks hiding secrets too scandalous to be revealed.</span>

                            <span class="flex flex-row mt-5 space-x-2 mr-20">
                                <button class="p-2 basis-1/3 rounded-md text-white font-semibold bg-[#28353e]">Join Event</button>

                                <span class="flex flex-row basis-2/3 space-x-2 justify-end">
                                    <span class="p-2 rounded-md text-white font-semibold">
                                        Starting on <b>March 23, 2023</b> @ <b>09:00 AM</b>
                                    </span>
                                </span>
                            </span>
                        </td>

                        <td class="flex justify-end space-x-1 h-full w-full basis-1/4">
                            <img class="rounded-lg" src="https://timelinecovers.pro/facebook-cover/download/Best-Covers-For-Facebook-Timeline-sunflower.jpg">
                        </td>

                    </tr>

                    <tr class="flex bg-[#1b2730] opacity-90 rounded-lg p-3 px-6 mb-1 h-72 space-x-4">
                        <!-- name, niche, date time, pics -->
                        <td class="flex flex-col basis-3/4">
                            <span class="text-white text-sm font-semibold">University Presents</span>
                            <span class="text-white text-left text-3xl font-semibold row-start-2">Event Name</span>
                            <span class="text-white font-light row-start-3 text-justify mt-5 mr-20">Welcome to the darkest depths of your desires at "Midnight Masquerade," a seductively sinister soirée that will leave you yearning for more. Step into a shadowy realm where mischief reigns and inhibitions dissolve like mist in the moonlight. Surrender to the allure of forbidden fantasies as enigmatic figures dance through the haze, their masks hiding secrets too scandalous to be revealed.</span>

                            <span class="flex flex-row mt-5 space-x-2 mr-20">
                                <button class="p-2 basis-1/3 rounded-md text-white font-semibold bg-[#28353e]">Join Event</button>

                                <span class="flex flex-row basis-2/3 space-x-2 justify-end">
                                    <span class="p-2 rounded-md text-white font-semibold">
                                        Starting on <b>March 23, 2023</b> @ <b>09:00 AM</b>
                                    </span>
                                </span>
                            </span>
                        </td>

                        <td class="flex justify-end space-x-1 h-full w-full basis-1/4">
                            <img class="rounded-lg" src="https://timelinecovers.pro/facebook-cover/download/Best-Covers-For-Facebook-Timeline-sunflower.jpg">
                        </td>

                    </tr>

                    <tr class="flex bg-[#1b2730] opacity-90 rounded-lg p-3 px-6 mb-1 h-72 space-x-4">
                        <!-- name, niche, date time, pics -->
                        <td class="flex flex-col basis-3/4">
                            <span class="text-white text-sm font-semibold">University Presents</span>
                            <span class="text-white text-left text-3xl font-semibold row-start-2">Event Name</span>
                            <span class="text-white font-light row-start-3 text-justify mt-5 mr-20">Welcome to the darkest depths of your desires at "Midnight Masquerade," a seductively sinister soirée that will leave you yearning for more. Step into a shadowy realm where mischief reigns and inhibitions dissolve like mist in the moonlight. Surrender to the allure of forbidden fantasies as enigmatic figures dance through the haze, their masks hiding secrets too scandalous to be revealed.</span>

                            <span class="flex flex-row mt-5 space-x-2 mr-20">
                                <button class="p-2 basis-1/3 rounded-md text-white font-semibold bg-[#28353e]">Join Event</button>

                                <span class="flex flex-row basis-2/3 space-x-2 justify-end">
                                    <span class="p-2 rounded-md text-white font-semibold">
                                        Starting on <b>March 23, 2023</b> @ <b>09:00 AM</b>
                                    </span>
                                </span>
                            </span>
                        </td>

                        <td class="flex justify-end space-x-1 h-full w-full basis-1/4">
                            <img class="rounded-lg" src="https://timelinecovers.pro/facebook-cover/download/Best-Covers-For-Facebook-Timeline-sunflower.jpg">
                        </td>

                    </tr>
                </table>
            </div>
        </div>
        @endif

</body>

</html>

<script>
    $(document).ready(function() {

        $('#profileArea').on('click', function(event) {
            $('#profileDropDown').toggle();
        });

        // $('#profileArea').focusout(function(event) {
        //     if (!$('#profileArea').is(event.relatedTarget)) {
        //         $('#profileDropDown').toggle();
        //     }
        // });
    });
</script>