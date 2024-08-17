<x-layout>


    <br>
    <h4 style="text-align: center;"> Task Details </h4>
    <br>

    <div class="table w-full p-2">
      
      <p> <b> Task ID : </b> {{ $task->id }}</p><br>
      <p> <b> Task Name : </b> {{ $task->title }}</p><br>
      
      @if ( $task->project != NULL )
        <p> <b> Task Project Name : </b> <a href="{{ route('projects.show', $task->project) }}">   {{ $task->project->title }}  </a> </p><br>
      @else  
        <p> <b> Task Project Name : </b> None Project </p><br>
      @endif
      <p> <b> Task Description : </b> {!! nl2br(e($task->descr)) !!} </p><br>
      <p> <b> Task Priority : </b> {{ $task->priority }}</p><br>
      <p> <b> Task Created At : </b> {{ $task->created_at }}</p>

      <br>
      <a href="{{ route('tasks.edit', $task) }}" class="bg-blue-500 p-1 text-white hover:shadow-lg text-xs font-thin">Edit</a>
      <br><br>
      <form action="{{ route('tasks.destroy', $task) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-red-500 p-1 text-white hover:shadow-lg text-xs font-thin"> Delete</button>
      </form>

    </div>

    <br>
    <a href="{{ route('tasks.index') }}"><button class="btn btn-primary"> << Task List </button> </a>
    <br>



</x-layout>


