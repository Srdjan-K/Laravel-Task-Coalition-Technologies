<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME')}}</title>

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-slate-100 text-slate-900">

        <header class="bg-slate-800 shadow-lg">
            <nav>

              <a href="/home" class="nav-link">HOME</a>

              @auth
                <div class="relative grid place-items-center" x-data="{ open: false }">

                    {{-- DropDown Menu MAIN Img Button --}}
                    <button  x-on:click="open = !open"  type="button" class="round-btn">
                        <img src="https://picsum.photos/200" alt="">
                    </button>

                    {{-- DropDown Menu --}}
                    <div x-show="open"  @click.outside="open = false" class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light p-3">
                        <p class="">{{ auth()->user()->username }}</p>
                        <a href="{{ route('dashboard') }}" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">DashBoard</a>
                        <a href="{{ route('projects.index') }}" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Projects</a>
                        <a href="{{ route('tasks.index') }}" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Tasks</a>
                        
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="block w-full text-left hover:bg-slate-100 pl-4 pr-8 py-2" >
                                LogOut
                            </button>
                        </form>
                    </div>

                </div>
              @endauth

              @guest
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href={{ route('register') }} class="nav-link">Register</a>
                    
                </div>
              @endguest
              
            </nav>
        </header>

        <main class="py-8 px-4 mx-auto max-w-screen-lg">
            @auth
                <h6> LoggedIn ! </h6>
                <h4> Welcome user , {{ auth()->user()->username }} </h4> 
                <hr>
            @endauth

            @guest
                {{-- <h6> Sorry, you are NOT logged in . . .  </h6>     --}}
            @endguest
            

            {{ $slot }}

            
        </main>
        
        
    </body>
</html>
