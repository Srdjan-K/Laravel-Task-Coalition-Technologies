<x-layout>

  <h1 class="title"> Welcome Back </h1>

  <div class="mx-auto max-w-screen-sm card">

    <form action="{{ route('login') }}" method="POST">

      @csrf
      
      {{-- Email --}}
      <div class="mb-4">
        <label for="email"> Email </label>
        <input type="text" name="email" value="{{ old('email') }}" class="input
        @error('email') ring-red-500 @enderror">
        @error('email')
          <p class="error"> {{ $message }} </p>
        @enderror
      </div>

      {{-- PassWord --}}
      <div class="mb-4">
        <label for="password"> Password </label>
        <input type="password" name="password" class="input
        @error('password') ring-red-500 @enderror">
        @error('password')
          <p class="error"> {{ $message }} </p>
        @enderror
      </div>
      
      {{-- Remember Me - CheckBox --}}
      <div class="mb-4">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember"> Remember Me </label>
      </div>


      @error('failed')
        <p class="error"> {{ $message }} </p>
      @enderror


      {{-- Submit Button --}}
      <button class="btn mt-5"> Login </button>


    </form>
  </div>

</x-layout>