<x-layout>


    <br>
    <h4 style="text-align: center;"> Project Details </h4>
    <br>

    <div class="table w-full p-2">
      
      <p> <b> Project ID : </b> {{ $project->id }}</p><br>
      <p> <b> Project Name : </b> {{ $project->title }}</p><br>
      <p> <b> Project Description : </b> {!! nl2br(e($project->descr)) !!} </p><br>
      <p> <b> Project Created At : </b> {{ $project->created_at }}</p>
      
      <br>
      <a href="{{ route('projects.edit', $project) }}" class="bg-blue-500 p-1 text-white hover:shadow-lg text-xs font-thin">Edit</a>
      <br><br>
      <form action="{{ route('projects.destroy', $project) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-red-500 p-1 text-white hover:shadow-lg text-xs font-thin"> Delete</button>
      </form>

    </div>

    <br>
    <a href="{{ route('projects.index') }}"><button class="btn btn-primary"> << Project List </button> </a>
    <br>




</x-layout>


