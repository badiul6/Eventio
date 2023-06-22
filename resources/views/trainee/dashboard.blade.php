<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">


    @vite('resources/css/app.css')
    @vite('resources/js/trainee.js')
</head>

<body>
    @if (is_null(auth()->user()->trainee))
    @include("trainee.createprofile")
    @else
    @include("trainee.updateprofile")
    @include("trainee.editpic")
    @include("trainee.editcover")
    <div class="flex h-screen items-center p-3 bg-slate-200">
        <div class="flex bg-white flex-grow items-center rounded-2xl h-full p-4 border-[3px] border-[#d2e0ff]">
            <div class="flex flex-col basis-1/6 h-full items-center pt-6">
                <img src="{{asset('imgs/logo.svg')}}" width="256px">

                <div class="flex flex-col pt-16 h-full w-full mb-7 items-center space-y-5">
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
                            <i class=" fas fa-sign-out-alt mx-2"></i>
                            <input type="submit" value="Logout" class="font-semibold cursor-pointer">
                        </form>
                    </div>
                </div>

            </div>

            <div class="flex flex-col bg-white basis-4/5 h-full p-5 border-x-[3px] border-slate-200 px-10">
                <div class="flex">
                    <div class="flex flex-col basis-4/5">
                        <span class="text-4xl font-semibold text-[#5776f1]">Hello, {{$train->first_name." " .$train->last_name}}</span>
                        <span class="text-[#92a5f4]">Track your events here, stay up-to-date!</span>
                    </div>
                    <div class="flex justify-end m-2 items-top basis-2/5 px-2">
                        <p class="font-semibold mt-1 text-[#8c9df4] text-lg">{{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
                        <i class="bg-[#e6efff] text-[#8c9df4] rounded-full far fa-calendar-alt fa-lg mx-2 h-fit p-3"></i>
                    </div>
                </div>

                <hr class="h-px mt-8 mb-2 border-[2px] border-[#d2e0ff] rounded-xl">

                <span class="mt-5 text-lg font-semibold text-[#5776f1]">
                    My Events
                </span>

                <div class="flex flex-col px-2 py-2 space-y-4 basis-5/6 flex-grow-0 overflow-auto relative scrollbar-thumb">
                    <table>
                        @foreach($upcomingEvents as $event)
                        <tr id="{{$event->id}}" name="event-update" class="grid bg-[#e6efff] rounded-2xl p-3 px-6 grid-cols-2 grid-rows-2 mb-1">
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
                        </tr>
                        @endforeach
                    </table>
                </div>

                <span class="mt-2 text-lg font-semibold text-[#5776f1]">
                    My Completed Events
                </span>

                <div class="flex flex-col px-2 py-2 space-y-4 basis-5/6 flex-grow-0 overflow-auto relative scrollbar-thumb">
                    <table>
                        @foreach($completedEvents as $event)
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
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="flex flex-col p-5 basis-3/12 h-full border-[#d2e0ff] space-y-3 flex-grow-0 ">
                <div class="flex flex-col bg-[#e6efff] rounded-2xl w-full basis-1/5">
                    <div class="flex flex-col items-center pb-5">
                        <div class="flex flex-col w-full items-center rounded-lg">
                            @if ($pic)
                            <img id="cover" class="object-cover w-full h-[100px] bg-gray-100 rounded-t-lg" src={{strlen($pic->cover_path) == 0 ? 'https://cdn.pixabay.com/photo/2015/12/22/04/00/photo-1103595_1280.png' : asset('/uploads/'.$pic->cover_path)}}>
                            <img class="h-[70px] w-[70px] bg-gray-100 rounded-full mt-[-12%]" src={{strlen($pic->dp_path) == 0 ? 'https://ionicframework.com/docs/img/demos/avatar.svg' : asset('/uploads/'.$pic->dp_path)}}>
                            @else
                            <img id="cover" class="object-cover w-full h-[100px] bg-gray-100 rounded-t-lg" src="https://cdn.pixabay.com/photo/2015/12/22/04/00/photo-1103595_1280.png">
                            <img class="h-[78px] w-[78px] bg-gray-100 rounded-full mt-[-12%]" src="https://ionicframework.com/docs/img/demos/avatar.svg">
                            @endif<button id="editPic" class="h-20 w-20  opacity-0 rounded-full mt-[-21%]">
                                <i class="hover:opacity-100 rounded-full fas fa-pencil-alt fa-xl text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col items-center py-3">
                        <label class="text-[#5776f1] font-semibold mt-[-15px] text-center text-lg">{{$train->name}}</label>
                        <label class="text-[#93a3f5] text-sm font-semibold">{{"@" . $train->user->name}}</label>
                        <label class="text-[#5776f1] text-sm font-semibold mx-10 text-center mt-2">{{$train->bio}}</label>
                    </div>
                </div>

                <div class="flex flex-col py-2 space-y-4 flex-grow-0 overflow-auto relative">
                    <h3 class="w-full text-center text-xl font-semibold text-[#5776f1]">Activity</h3>
                    @foreach($invites as $invite)
                    <div class="flex flex-col overflow-auto">
                        <div class="flex h-full px-5 flex-col items-center justify-center rounded-2xl bg-[#e6efff] w-full">
                            <div class="flex flex-row pr-2 pl-0 py-2 items-center h-20 justify-center rounded-2xl w-full overflow-clip flex-grow-0 space-x-3 rounded-l-lg">
                                @if(is_null($invite->event->university->user->picture))
                                <img src="{{asset('/uploads/uni.jpg')}}" alt="user image" width="78px" class="w-86 h-86 rounded-full"/>
                                @else
                                <img src="{{asset('/uploads/'.$invite->event->university->user->picture->dp_path)}}" alt="user image" width="78px" class="w-10 h-10   rounded-full" />
                                @endif
                                <span class="text-sm text-left"><span class="font-semibold">{{$invite->event->university->name}}</span> invites you for <span class="font-semibold">{{$invite->event->name}}</span>!</span>
                            </div>

                            <div class="flex p-2 space-x-2">
                                <form action="{{route('invite.accept')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$invite->id}}">
                                    <button type="submit">
                                        <i class="fa fa-check-circle fa-lg text-green-400 bg-white rounded-full"></i>
                                    </button>

                                </form>
                                <form action="{{route('invite.decline')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$invite->id}}">
                                    <button type="submit">
                                        <i class="fa fa-times-circle fa-lg text-red-400 bg-white rounded-full"></i>
                                    </button>
                                </form>
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