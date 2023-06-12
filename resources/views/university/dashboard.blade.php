<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">

    @vite('resources\js\university.js')
    @vite('resources/css/app.css')
</head>

<body>

    @if (is_null(auth()->user()->university))
    @include("university.createprofile")
    @else
    @include("university.editevent")
    @include("university.createevent")
    @include("university.updateprofile")
    @include("university.editpic")
    <div class="flex h-screen items-center p-3 bg-slate-200">
        <div class="flex bg-white flex-grow items-center rounded-2xl h-full p-4 border-[3px] border-[#d2e0ff]">
            <div class="flex flex-col basis-1/6 h-full items-center pt-6">
                <img src="{{asset('imgs/logo.svg')}}" width="256px">

                <div class="flex flex-col pt-16 h-full w-full mb-7 items-center space-y-5">
                    <button id="event-modal" class="flex items-center font-semibold w-full py-2 rounded-full text-[#92a5f4] hover:text-[#5776f1]">
                        <i class=" fas fa-pencil-alt mx-2"></i>
                        <span class="w-full">Create Event</span>
                    </button>

                    <button id="update-modal" class="flex items-center font-semibold w-full py-2 rounded-full text-[#92a5f4] hover:text-[#5776f1]">
                        <i class=" fas fa-sync mx-2 "></i>
                        <span class=" w-full">Update Profile</span>
                    </button>

                    <div class="width h-full">&nbsp;</div>
                    <div class="w-full">
                        <form action="{{route('profile.edit')}}" method="get" class="w-full py-2 rounded-full text-[#92a5f4] hover:text-[#5776f1]">
                            @csrf
                            <i class="fas fa-user-cog mx-2 "></i>
                            <input type="submit" value="Settings" class="font-semibold cursor-pointer">
                        </form>
                    </div>

                    <div class="w-full">
                        <form action="{{route('logout')}}" method="post" class="w-full py-2 rounded-full text-[#92a5f4] hover:text-[#5776f1]"">
                            @csrf   
                            <i class="fas fa-sign-out-alt mx-2 "></i>
                            <input type="submit" value="Logout" class="font-semibold cursor-pointer">
                        </form>
                    </div>
                </div>

            </div>

            <div class="flex flex-col bg-white basis-4/5 h-full p-5 border-x-[3px] border-[#d2e0ff] px-10">
                <div class="flex">
                    <div class="flex flex-col basis-4/5">
                        <span class="text-4xl font-semibold text-[#5776f1]">Hello, {{auth()->user()->name}}</span>
                        <span class="text-[#92a5f4]">Track your events here, stay up-to-date!</span>
                    </div>
                    <div class="flex justify-end m-2 items-top basis-2/5 px-2">
                        <p class="font-semibold mt-1 text-[#8c9df4] text-lg">{{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
                        <i class="bg-[#e6efff] text-[#8c9df4] rounded-full far fa-calendar-alt fa-lg mx-2 h-fit p-3"></i>
                    </div>
                </div>

                <hr class="h-px mt-8 mb-2 border-[2px] border-[#d2e0ff] rounded-xl">

                <div class="flex space-x-1">
                    <div class="flex basis-1/3 px-6 items-center space-x-4 border-r-[3px] border-[#d2e0ff]">
                        <i class="fas fa-2x fa-clock text-gray-500"></i>
                        <div class="w-full">
                            <p class="text-lg font-semibold text-[#92a5f4]">Pending</p>
                            <span class="text-[#92a5f4] font-medium">{{$pevent. " " . "event(s)"}}</span>
                        </div>
                    </div>
                    <div class="flex basis-1/3 px-6 py-2 items-center space-x-4 border-r-[3px] border-[#d2e0ff]">
                        <i class="fas fa-2x fa-hourglass-half text-yellow-300"></i>
                        <div class="w-full">
                            <p class="text-lg font-semibold text-[#92a5f4]">In Progress</p>
                            <span class="text-[#92a5f4] font-medium">{{$aevent. " " . "event(s)"}}</span>
                        </div>
                    </div>
                    <div class="flex basis-1/3 px-6 items-center space-x-4 border-[#d2e0ff]">
                        <i class="fas fa-2x fa-check-circle text-green-500"></i>
                        <div class=" w-full">
                            <p class="text-lg font-semibold text-[#92a5f4]">Completed</p>
                            <span class="text-[#92a5f4] font-medium">{{$cevent . " " . "event(s)"}}</span>
                        </div>
                    </div>
                </div>

                <hr class="h-px mt-2 mb-2 border-[2px] border-[#d2e0ff] rounded-xl">

                <span class="mt-5 text-lg font-semibold text-[#5776f1]">
                    Pending Events
                </span>
                <div class="flex flex-col px-2 py-2 space-y-4 basis-5/6 flex-grow-0 overflow-auto relative scrollbar-thumb">
                    <table>
                        @foreach($upcomingEvents as $event)
                        <tr id="{{$event->id}}" name="event-update" class="grid bg-[#e6efff] rounded-2xl p-3 px-6 grid-cols-2 grid-rows-2 mb-1">
                            <!-- name, niche, date time, pics -->
                            <td class="text-xl font-semibold">
                                <i class="fas fa-star text-[#8c9df4]"></i>
                                <span>{{$event->name}}</span>
                            </td>
                            <td class="text-right">
                                <span>
                                    <i class="fas fa-clock text-[#8c9df4]"></i>
                                    {{date('F d, Y', strtotime($event->date))}}
                                    <i class="fas fa-calendar-alt ml-5 text-[#8c9df4]"></i>
                                    {{date('h:i A', strtotime($event->start_time))}}
                                    <i class="fas fa-arrow-right text-[#8c9df4]"></i>
                                    {{date('h:i A', strtotime($event->end_time))}}
                                </span>
                            </td>
                            <td class="font-light">
                                <i class="fas fa-tag mx-1 text-[#8c9df4]"></i>
                                <span>{{$event->topic->topic_name}}</span>
                            </td>
                            <td class="flex text-right space-x-1 justify-end">
                                <img class="h-8 rounded-2xl border-2 border-red-500" src="https://randomuser.me/api/portraits/lego/1.jpg">
                                <img class="h-8 rounded-2xl border-2 border-green-500" src="https://randomuser.me/api/portraits/lego/2.jpg">
                                <img class="h-8 rounded-2xl" src="https://randomuser.me/api/portraits/lego/3.jpg">
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <span class="mt-2 text-lg font-semibold text-[#5776f1]">
                    Live / Completed Events
                </span>

                <div class="flex flex-col px-2 py-2 space-y-4 basis-5/6 flex-grow-0 overflow-auto relative scrollbar-thumb">
                    <table>
                        @foreach($events as $event)
                        <tr class="grid bg-[#e6efff] rounded-2xl p-3 px-6 grid-cols-2 grid-rows-2 mb-1">
                            <td class="text-xl font-semibold">
                                <i class="fas fa-star text-[#8c9df4]"></i>
                                <span>{{$event->name}}</span>
                            </td>
                            <td class="text-right">
                                <span>
                                    <i class="fas fa-clock text-[#8c9df4]"></i>
                                    {{date('F d, Y', strtotime($event->date))}}
                                    <i class="fas fa-calendar-alt ml-5 text-[#8c9df4]"></i>
                                    {{date('h:i A', strtotime($event->start_time))}}
                                    <i class="fas fa-arrow-right text-[#8c9df4]"></i>
                                    {{date('h:i A', strtotime($event->end_time))}}
                                </span>
                            </td>
                            <td class="font-light">
                                <i class="fas fa-tag mx-1 text-[#8c9df4]"></i>
                                <span>{{$event->topic->topic_name}}</span>
                            </td>
                            <td class="flex text-right space-x-1 justify-end">
                                <img class="h-8 rounded-2xl border-2 border-red-500" src="https://randomuser.me/api/portraits/lego/1.jpg">
                                <img class="h-8 rounded-2xl border-2 border-green-500" src="https://randomuser.me/api/portraits/lego/2.jpg">
                                <img class="h-8 rounded-2xl" src="https://randomuser.me/api/portraits/lego/3.jpg">
                            </td>
                        </tr>
                        @endforeach



                    </table>
                </div>

            </div>

            <div class="flex flex-col p-5 basis-3/12 h-full border-[#d2e0ff] space-y-3 flex-grow-0 ">
                <div class="flex flex-col bg-[#e6efff] rounded-2xl w-full basis-1/5">
                    <div class="flex flex-col items-center pb-5">
                        <div class="flex flex-col w-full items-center rounded-lg">
                            <img class="h-full bg-gray-100 rounded-t-lg" src="https://timelinecovers.pro/facebook-cover/download/Best-Covers-For-Facebook-Timeline-sunflower.jpg">

                            <img class="h-20 bg-gray-100 rounded-full mt-[-16%]" src="https://randomuser.me/api/portraits/lego/2.jpg">
                            <button id="editPic" class="h-20 w-20  opacity-0 rounded-full mt-[-30%] hover:opacity-70 hover:bg-gray-400">
                                <i class="hover:opacity-100 rounded-full fas fa-pencil-alt fa-xl text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col items-center py-3">
                        <label class="text-[#5776f1] font-semibold mt-[-15px] text-lg text-center">{{$uni->name}}</label>
                        <label class="text-[#93a3f5] text-sm font-semibold">{{"@" . $uni->user->name}}</label>
                        <label class="text-[#5776f1] text-sm font-semibold mx-10 text-center mt-2">{{$uni->description}}</label>
                    </div>
                </div>

                <div class="flex flex-col py-2 space-y-4 flex-grow-0 overflow-auto relative">
                    <h3 class="w-full text-center text-xl font-semibold text-[#5776f1]">Activity</h3>
                    @foreach($invites as $invite)
                    <div class="flex flex-col space-y-3 overflow-auto">
                        <div class="flex flex-row items-center justify-center rounded-2xl w-full cursor-pointer">
                            <div class="flex flex-row pr-2 pl-0 py-2 bg-[#e6efff] items-center h-20 justify-center rounded-2xl w-full overflow-clip flex-grow-0 space-x-3 rounded-l-lg">
                                <img src="https://randomuser.me/api/portraits/men/21.jpg" alt="user image" width="78px" />
                                <span class="text-sm"><span class="font-semibold">{{$invite->trainee->first_name}}&nbsp;{{$invite->trainee->last_name}}</span> {{$invite->status}} your invitation to join <span class="font-semibold">{{$invite->event->name}}</span>!</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        @endif

</body>

</html>