<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  @vite('resources/css/app.css')
</head>

<body class="login">
  <form action="{{route('login')}}" method="POST">
    @csrf
    <div class="flex justify-center items-center mb-8">
      <a href="/">
        <img src="/imgs/logo.svg" width="300px">
      </a>
    </div>
    <div class="container max-w-md mx-auto bg-white p-6 text-center border border-gray-300 rounded-lg shadow-md">
      <div class="logo">
        <h1 class="text-blue-500 mb-6 text-3xl font-semibold">Login</h1>
        <!-- <img src="instagram-logo.png" alt="Instagram Logo"> -->
      </div>
      <div class="form-container">
        <x-text-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        <div class="mt-4">
          <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />

          <x-input-error :messages="$errors->get('password')" class="mt-2" />
          <label class="flex items-center mr-4 mt-5">
            <input type="checkbox" name="remember" class="mr-4 checked:outline-none">
            <span class="text-sm text-gray-600">Remember Me</span>
          </label>
          <input type="submit" value="Login" class="w-full bg-blue-500 text-white rounded-lg py-2 mt-4 hover:bg-blue-600 cursor-pointer">
        </div>
      </div>
      <div class="divider flex items-center mt-6">
        <div class="flex-grow h-px bg-gray-300"></div>
        <span class="mx-4 text-sm text-gray-500 uppercase">OR</span>
        <div class="flex-grow h-px bg-gray-300"></div>
      </div>
      <div class="sign-up mt-4">
        Don't have an account? <a href="#" class="text-blue-500">Sign up</a>
      </div>
    </div>
  </form>
</body>

</html>