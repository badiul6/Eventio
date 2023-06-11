<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="/js/jquery.js"></script>
    <title>Laravel</title>
    @vite('resources/css/app.css')
</head>

<body>

    <nav class="relative flex flex-row border-b-2 md:pr-10">
        <div class="basis-2/3 ">
            <a class="bg-red-100" href="/"><img src="{{asset('/imgs/logo.svg')}}" width="164px"></a>
        </div>
        <div class="flex justify-end basis-1/3 px-4 space-x-5 py-3">
            <a class="hidden items-center md:flex" href="login">Login</a>
            <a class="flex items-center rounded-full bg-blue-500 hover:bg-blue-400 px-5 text-white" href="signup">Sign Up</a>
        </div>
    </nav>

    <div>
        <section class="mx-4 mt-1 md:pt-28 lg:px-20 lg:pt-14">
            <div class="flex flex-col-reverse items-center md:flex-row pt-20 md:pt-5">
                <div class="flex flex-col  items-center basis-3/5 md:items-start ">
                    <h2 class="text-2xl text-indigo-800 font-bold text-center flex basis-full items-center md:text-4xl md:text-left md:basis-1/5">Connect, Collaborate, Succeed: Unleash Your Event Potential!</h2>
                    <p class="text-center text-gray-700 basis-full font-medium md:text-left">Revolutionize your event experience. Where brilliance meets opportunity. Embrace greatness. Right Now. Right Here.</p>
                    <form class="flex justify-center md:justify-start basis-full mt-5 w-full" action="{{route('choose.user')}}" method="get">
                        @csrf
                        <input id="continueBtn" class="p-2 text-2xl text-center text-white rounded-3xl bg-blue-500 w-5/6 hover:bg-blue-500 cursor-pointer transition-all duration-500 ease-in-out hover:scale-110 md:w-1/3 md:duration-600 md:ease-linear" type="submit" value="Get Started">
                    </form>
                </div>
                <div class="flex items-center justify-center basis-4/5 md:w-full">
                    <img class="w-full md:w-full md:-mt-24" src="{{asset('/imgs/landing_img.svg')}}">
                </div>
            </div>
        </section>
    </div>

    <div class="hidden md:block bg-slate-50 bottom-0">
        <img class="absolute bottom-0" src="{{asset('/imgs/waves.svg')}}" height="10%">
    </div>
</body>

</html>