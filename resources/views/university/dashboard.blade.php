
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    
    @vite('resources\js\university.js')
    @vite('resources/css/app.css')
</head>

<body>
    
    @if (is_null(auth()->user()->university))
        @include("university.createprofile")
    @else
    @include("university.createevent")
    @include("university.updateprofile")
    <div class="flex h-screen items-center p-3 bg-slate-200">
        <div class="flex bg-white flex-grow items-center rounded-2xl h-full p-4 border-[3px] border-slate-200">
            <div class="flex flex-col basis-1/6 h-full items-center pt-6">
                <img src="{{asset('imgs/logo.svg')}}" width="64px">
                <span>Eventio</span>

                <div class="flex flex-col pt-16 h-full w-3/4 mb-7 items-center space-y-5 p-5">
                    <button id="event-modal">Create Event</button>
                    <button id="update-modal">Update</button>

                    <div class="width h-full">&nbsp;</div>
                    <form  action="{{route('profile.edit')}}" method="get">
                        <input type="submit" value="Account Settings" class="cursor-pointer">
                    </form>
                    <div >
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <input type="submit" value="Logout" class="cursor-pointer">
                        </form>
                    </div>
                </div>

            </div>

            <div class="flex flex-col bg-white basis-4/5 h-full p-5 border-x-[3px] border-slate-200 px-10">
                <div class="flex">
                    <div class="flex flex-col basis-4/5">
                        <span class="text-4xl font-semibold">Hello, {{auth()->user()->name}}</span>
                        <span class="text-sm">Track your events here, stay up-to-date!</span>
                    </div>
                    <div class="flex justify-end m-2 items-top basis-1/5 px-2">
                        <p class="font-semibold text-sm">{{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
                    </div>
                </div>
                <hr class="h-px mt-8 mb-2 border-[2] border-slate-300 rounded-xl">

                <div class="flex space-x-1">
                    <div class="flex basis-1/3 px-6 items-center space-x-4 border-r-[3px] border-slate-200">
                        <div>
                            <img src="{{asset('imgs/logo.svg')}}" width="30px">
                        </div>
                        <div class="w-full text-center">
                            <p>In Progress</p>
                            <span>{{$aevent}}</span>
                        </div>
                    </div>
                    <div class="flex basis-1/3 px-6 py-2 items-center space-x-4 border-r-[3px] border-slate-200">
                        <div>
                            <img src="{{asset('imgs/logo.svg')}}" width="30px">
                        </div>
                        <div class="w-full text-center" <p>Completed</p>
                            <span>{{$cevent}}</span>
                        </div>
                    </div>
                    <div class="flex basis-1/3 px-6 items-center space-x-4 border-slate-200">
                        <div>
                            <img src="{{asset('imgs/logo.svg')}}" width="30px">
                        </div>
                        <div class=" w-full text-center" <p>Pending</p>
                            <span>{{$pevent}}</span>
                        </div>
                    </div>
                </div>

                <hr class="h-px mt-2 mb-2 border-[2] border-slate-300 rounded-xl">

                <div>

                </div>
                <div class="flex flex-col px-2 py-2 space-y-4 basis-5/6 flex-grow-0 overflow-auto relative scrollbar-thumb">

                    <table>
                        <tr class="grid bg-slate-100 opacity-90 rounded-lg p-3 px-6 grid-cols-2 grid-rows-2 mb-1">
                            <!-- name, niche, date time, pics -->
                            <td class="text-xl font-semibold">Name</td>
                            <td class="text-right text-sm font-light">Date Time</td>
                            <td class="font-light">Sports</td>
                            <td class="flex text-right space-x-1 justify-end">
                                <img class="h-8 rounded-2xl border-2 border-red-500" src="https://randomuser.me/api/portraits/lego/1.jpg">
                                <img class="h-8 rounded-2xl border-2 border-green-500" src="https://randomuser.me/api/portraits/lego/2.jpg">
                                <img class="h-8 rounded-2xl" src="https://randomuser.me/api/portraits/lego/3.jpg">
                            </td>
                        </tr>

                       

                    </table>
                </div>

            </div>

            <div class="flex flex-col p-5 basis-2/6 h-full border-slate-200 space-y-3 flex-grow-0">
                <div class="flex flex-col basis-1/5 bg-slate-100 mx-5 rounded-xl">
                    <div class="flex flex-col items-center pb-5">
                        <div class="flex flex-col w-full items-center rounded-lg">
                            <img class="h-20 bg-gray-100 rounded-t-lg" src="https://marketplace.canva.com/EAEmB3DmXk0/1/0/1600w/canva-bright-gradient-lettering-rainbow-facebook-cover-0Z5QgybLshE.jpg" width="100%">
                            <img class="h-20 bg-gray-100 rounded-full mt-[-16%] border-[3px] border-white" src="https://randomuser.me/api/portraits/lego/2.jpg">
                        </div>
                        <span class="font-semibold">{{$uni->name}}</span>
                        <span class="text-sm font-light">{{$uni->description}}</span>
                    </div>
                </div>

                <div class="flex flex-col px-2 py-2 space-y-4 flex-grow-0 overflow-auto relative">
                    <h3 class="text-center overflow-hidden before:h-[1px] after:h-[1px] after:bg-blue-300
           after:inline-block after:relative after:align-middle after:w-1/4 
           before:bg-blue-300 before:inline-block before:relative before:align-middle 
           before:w-1/4 before:right-2 after:left-2 text-xl p-4">Activity
                    </h3>
@foreach($invites as $invite)
                    <div class="flex flex-col space-y-3  overflow-auto">
                        <div class="flex flex-row px-6 pl-0 items-center justify-center rounded-2xl bg-slate-100 w-full cursor-pointer ">
                            <div class="flex flex-row px-6 pl-0 py-2 items-center h-16 justify-center rounded-2xl bg-slate-100 w-full cursor-pointer overflow-clip flex-grow-0 space-x-3 rounded-l-lg">
                                <img class="rounded-full border border-gray-100 shadow-xl shadow-blue-300 ml-[-10px]" src="https://randomuser.me/api/portraits/men/21.jpg" alt="user image" width="78px" />
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
