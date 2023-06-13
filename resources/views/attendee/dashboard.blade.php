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
    @include("attendee.editpic")
    @include("attendee.editcover")
    <div class="flex flex-col bg-[#06141d] h-screen p-3 overflow-auto">

        <div class="pr-12">
            <div class="flex flex-row">
                <img class="h-10 rounded-lg basis-1/12" src={{asset('imgs/logo.svg')}}>

                <div class="flex justify-end w-full basis-11/12 items-center">
                    <div id="profileArea" class="relative">
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-full bg-[#3e4a52]  focus:outline-none">
                            @if(is_null($pic))
                            <img class="w-8 h-8 rounded-full" src="{{asset('/uploads/dp.png')}}">
                            @else
                            <img class="w-8 h-8 rounded-full" src="{{asset('/uploads/'.$pic->dp_path)}}">
                            @endif
                            <span class="text-white font-semibold">{{auth()->user()->name}}</span>
                            <svg class="w-4 h-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div id="profileDropDown" class="hidden absolute right-0 mt-2 w-48 bg-[#3e4a52] rounded-md shadow-lg z-10">
                            <div class="block px-4 py-2 text-white hover:bg-gray-500">
                                <button id="uupdate" class="text-left w-full" data-modal-toggle="defaultModal">
                                    Profile
                                </button>
                            </div>
                            <form action="{{route('profile.edit')}}" class="block px-4 py-2 text-white hover:bg-gray-500" method="get">
                                @csrf
                                <button type="submit" class="text-left w-full" data-modal-toggle="defaultModal">
                                    Settings
                                </button>
                            </form>
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
                        <div class="flex flex-col w-full h-1/3 items-center overflow-crop rounded-lg">
                            @if ($pic)
                            <img id="cover" class="object-cover w-full h-[100px] bg-gray-100 rounded-t-lg" src={{strlen($pic->cover_path) == 0 ? asset('/uploads/cover.jpg') : asset('/uploads/'.$pic->cover_path)}}>
                            <img class="h-[110px] w-[78px] bg-gray-100 rounded-full mt-[-12%]" src={{strlen($pic->dp_path) == 0 ? asset('/uploads/dp.png') : asset('/uploads/'.$pic->dp_path)}}>
                            @else
                            <img id="cover" class="object-cover w-full h-[100px] bg-gray-100 rounded-t-lg" src="https://cdn.pixabay.com/photo/2015/12/22/04/00/photo-1103595_1280.png">
                            <img class="h-[110px] w-[78px] bg-gray-100 rounded-full mt-[-12%]" src="https://ionicframework.com/docs/img/demos/avatar.svg">
                            @endif<button id="editPic" class="h-20 w-20  opacity-0 rounded-full mt-[-21%]">
                                <i class="hover:opacity-100 rounded-full fas fa-pencil-alt fa-xl text-white"></i>
                            </button>
                        </div>

                        <div class="flex flex-col mt-5 w-full items-center">
                            <label class="text-gray-100 font-semibold text-lg">{{$attendee->first_name . " " . $attendee->last_name}}</label>
                            <label class="text-gray-400 text-sm font-semibold">{{"@" . $user->name}}</label>
                            <label class="text-gray-100 text-sm font-semibold mx-10 text-center mt-2">{{$attendee->bio}}</label>
                            <span class="flex mt-8 border-1 border-[#4f5c66] border-t-2 w-full items-center py-3 justify-center">
                                <a class="m-1/2 h-full w-full text-center text-cyan-600 font-bold" id="update" href="#">My Profile</a>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Recent Events -->

                <div class="flex flex-col bg-[#1b2730] mx-5 rounded-2xl w-full h-1/2 p-2 overflow-y-auto scrollbar-hide">
                    <div class="flex flex-col pb-5">
                        <h2 class="text-gray-100 font-semibold text-lg p-2">Events | Joined</h2>
                        @foreach($joinedEvents as $event)
                        <!-- Joined Event 1 -->
                        <div class="flex flex-row rounded-lg mt-3 w-full p-2">
                        @if(is_null($event->university->user->picture))

                            <img class="w-14 h-14 bg-gray-100 rounded-full" src="{{asset('/uploads/uni.jpg')}}">
                           
                            @else
                            <img class="w-14 h-14 bg-gray-100 rounded-full" src="{{asset('/uploads/'.$event->university->user->picture->dp_path)}}">

                            @endif
                            <div class="ml-5">
                                <h1 class="text-gray-100 text-sm font-semibold">{{$event->name}}</h1>
                                <h1 class="text-gray-400 text-sm font-semibold">{{$event->university->name}}</h1>
                                <h1 class="text-gray-400 text-sm font-semibold">On {{date('F d, Y', strtotime($event->date))}}</h1>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
                <div class="flex flex-col bg-[#1b2730] mx-5 rounded-2xl w-full h-1/2 p-2 overflow-y-auto scrollbar-hide">
                    <div class="flex flex-col pb-5">
                        <h2 class="text-gray-100 font-semibold text-lg p-2">Events | Completed</h2>
                        @foreach($completedEvents as $event)
                        <!-- Joined Event 1 -->
                        <div class="flex flex-row rounded-lg mt-3 w-full p-2">
                        @if(is_null($event->university->user->picture))

<img class="w-14 h-14 bg-gray-100 rounded-full" src="{{asset('/uploads/uni.jpg')}}">

@else
<img class="w-14 h-14 bg-gray-100 rounded-full" src="{{asset('/uploads/'.$event->university->user->picture->dp_path)}}">

@endif
                            <div class="ml-5">
                                <h1 class="text-gray-100 text-sm font-semibold">{{$event->name}}</h1>
                                <h1 class="text-gray-400 text-sm font-semibold">{{$event->university->name}}</h1>
                                <h1 class="text-gray-400 text-sm font-semibold">Attended on {{date('F d, Y', strtotime($event->date))}}</h1>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>




            <!-- Center Bar -->
            <div class="flex flex-col basis-4/5 h-full p-5 rounded-2xl px-10 overflow-scroll scrollbar-hide">

                <table id="attendee-events" class="flex flex-col rounded-2xl w-full h-1/2">

                    @foreach($events as $event)
                    <tr class="flex bg-[#1b2730] opacity-90 rounded-lg p-3 px-6 mb-1 h-72 space-x-4">
                        <!-- name, niche, date time, pics -->
                        <td class="flex flex-col basis-3/4 flex-grow">
                            <span class="text-white text-sm font-semibold">{{$event->university->name}} Presents</span>
                            <span class="text-white text-left text-3xl font-semibold row-start-2">{{$event->name}}</span>
                            <span class="text-white basis-1/2 font-light row-start-3 text-justify mt-5 mr-20">{{$event->description}}</span>

                            <span class="flex flex-row mt-5 space-x-2 mr-20">
                                <form action="{{route('event.join')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{$event->id}}">
                                    <button type="submit" class="p-2 basis-1/3 rounded-md text-white font-semibold bg-[#28353e]">Join Event</button>
                                </form>
                                <span class="flex flex-row basis-2/3 space-x-2 justify-end">
                                    <span class="p-2 rounded-md text-white font-semibold">
                                        Starting on <b>{{date('F d, Y', strtotime($event->date))}}</b> @ <b>{{date('h:i A', strtotime($event->start_time))}} to {{date('h:i A', strtotime($event->end_time))}}</b>
                                    </span>
                                </span>
                            </span>
                        </td>

                        <td class="flex justify-end space-x-1 h-4/5 w-full basis-1/4 pt-10">
                            @if(is_null($event->university->user->picture))
                            <img class="rounded-lg" src="{{asset('/uploads/uni.jpg')}}">
                            @else
                            <img class="rounded-lg" src="{{asset('/uploads/'.$event->university->user->picture->dp_path)}}">
                            @endif
                        </td>

                    </tr>
                    @endforeach
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
        $('#update').on('click', function(event) {
            $('#updateModal').toggle();
        });
        $('#uupdate').on('click', function(event) {
            $('#updateModal').toggle();
        });
        $('button[name="m-close"]').click(function(event) {
            $(this).closest('div[name="Modal"]').hide();
        });

        $('button[id="editPic"]').click(function(event) {
            $('#picModal').toggle();
        });

        $('#cover').on('click', function(event) {
            $('#coverModal').toggle();
        });
    });
</script>