<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        
        .login {
    font-family: Arial, sans-serif;
    background-color: #fafafa;
    margin: 0;
    padding: 0;
  }
  
  .container {
    max-width: 350px;
    margin: 50px auto;
    background-color: #fff;
    padding: 30px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 3px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .logo img {
    width: 200px;
    margin-bottom: 20px;
  }
  
  .form-container input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 3px;
  }
  
  .form-container input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background-color: #3897f0;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }
  
  .divider {
    display: flex;
    align-items: center;
    margin: 20px 0;
  }
  
  .divider .line {
    flex-grow: 1;
    height: 1px;
    background-color: #ddd;
  }
  
  .divider span {
    margin: 0 10px;
    color: #999;
    font-size: 12px;
    text-transform: uppercase;
  }
  
  .sign-up {
    font-size: 14px;
    color: #999;
    margin-top: 10px;
  }
  
  .sign-up a {
    color: #3897f0;
    text-decoration: none;
  }
  
  .remember-me {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    font-size: 12px;
    color: hsl(0, 0%, 53%);
  }
  
  .remember-me input[type="checkbox"] {
    margin-right: -160px;
    margin-left: -170px;
    margin-top:8px;
  }
  h1{
    color: #3897f0;
    margin-bottom: 40px;

  }
  .f{
    text-align: center;
    margin-bottom: 0px;
}

.remember-me input[type="checkbox"] {
  margin-right: -160px;
  margin-left: -170px;
  margin-top:8px;
}
    </style>
</head>
<body class="login">
<div class="f">
            <a class="bg-red-100" href="/"><img src="/imgs/logo.svg" width="300px"></a>
        </div>
<div class="container">
  <div class="logo">
<h1 >Create Account</h1>
     <!-- <img src="instagram-logo.png" alt="Instagram Logo">  -->
  </div>
  <div class="form-container">
    <form action="{{route('register')}}" method="POST">
        @csrf
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

<x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password" placeholder="Password"/>

<x-input-error :messages="$errors->get('password')" class="mt-2" />

<x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password" 
                placeholder="Confirm password"/>

<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

      <input type="submit" value="Signup">
      <input type="hidden" name="role" value= "user">
        </form>
  </div>
  <div class="divider">
    <div class="line"></div>
    <span>OR</span>
    <div class="line"></div>
  </div>
  <div class="sign-up">
    Have an account? <a href="/login">Log in</a>
  </div>
</div>
</body>
</html>