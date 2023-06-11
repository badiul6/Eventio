<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  @vite('resources/css/app.css')
</head>

<body class="login">
  <div class="flex justify-center items-center mb-8">
    <a href="/">
      <img src="{{asset('/imgs/logo.svg')}}" width="300px">
    </a>
  </div>
  <div class="container max-w-md mx-auto bg-white p-6 text-center border border-gray-300 rounded-lg shadow-md">
    <h1 class="text-blue-500 mb-6 text-3xl font-semibold">Create University Account</h1>
    <div class="form-container">
      <form action="{{route('register')}}" method="POST">
        @csrf
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
          autofocus placeholder="Name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
          autocomplete="username" placeholder="Email" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />

        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
          autocomplete="new-password" placeholder="Password" />


        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
          name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password" />
          <x-input-error :messages="$errors->get('password')" class="mt-2" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

        <input type="submit" value="Signup"
          class="w-full bg-blue-500 text-white rounded-lg py-2 mt-4 hover:bg-blue-600 cursor-pointer">

        <input type="hidden" name="role" value="university">
      </form>
    </div>
    <div class="divider flex items-center mt-6">
      <div class="flex-grow h-px bg-gray-300"></div>
      <span class="mx-4 text-sm text-gray-500 uppercase">OR</span>
      <div class="flex-grow h-px bg-gray-300"></div>
    </div>
    <div class="sign-up mt-4">
      Have an account? <a href="/login" class="text-blue-500">Log in</a>
    </div>
  </div>
</body>

</html>
