<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body >
<div class="container mx-auto my-20 bg-white p-6 text-center border border-gray-300 rounded-lg shadow-md flex flex-wrap">
<img src="https://media-cdn.tripadvisor.com/media/photo-o/10/4a/72/06/haleji-lake.jpg" alt="" class="flex-grow w-auto">
<form action="{{route('university.store')}}" method="post" class="flex-grow w-auto">
    @csrf
    <h1 class="text">Create University profile</h1><br><br>
    <label for="uniname">University Name</label> <br>
    <input type="text" id="uniname" name="name">
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
</body>
</html>