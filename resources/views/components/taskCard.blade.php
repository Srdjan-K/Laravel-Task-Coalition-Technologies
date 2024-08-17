
@props(['task', 'full' => false ])


<div class="card">

    <div class="flex gap-6">

        {{-- Cover photo --}}
        {{-- <div class="h-auto w-1/3 rounded-md overflow-hidden self-start">
            @if ($task->image)
                <img src="{{ asset('storage/' . $task->image) }}" alt="">
            @else
                <img class="object-cover object-center rounded-md" src="{{ asset('storage/tasks_images/default.jpg') }}" alt="">
            @endif
        </div> --}}

        
        <div class="w-4/5">
            {{-- Title --}}
            <h2 class="font-bold text-xl"><b>{{ $task->id }}</b>. {{ $task->title }}</h2>
            
            {{-- Author and Date --}}
            <div class="text-xs font-light mb-4">
                <span> Created {{ $task->created_at->diffForHumans() }} by </span>
                <a href="{{ route('tasks.user', $task->project ) }}" class="text-blue-500 font-medium"> {{ $task->project->title }} </a>
                
                {{-- <h2 class="font-bold text-xl">{{ $task->title }}</h2> --}}
            </div>

            {{-- Task Body --}}
            @if ($full)
                <div class="text-sm">
                    <span> {!! nl2br(e($task->body)) !!} </span>
                </div>
            @else
                <div class="text-sm">
                    {{-- 2nd parameter = number of words to be shown --}}
                    <span> {{ Str::words( $task->body, 15 )}} </span>
                    <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 ml-2"> Read More &rarr; </a>
                </div>
            @endif

            <div class="flex items-center justify-end gap-4 mt-6">
                {{ $slot }}
            </div>

        </div>

    </div>
    
    
</div>


