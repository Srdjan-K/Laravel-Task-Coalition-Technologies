<x-layout>

  <a href="{{ route('tasks.index') }}" class="block mb-2 text-xs text-blue-500">&larr; Go back to your Task List </a>

  {{-- Update form card --}}
  <div class="card">
      <h2 class="font-bold mb-4">Update your Task</h2>

      <form action="{{ route('tasks.update', $task) }}" method="post" >
          @csrf
          @method('PUT')

          {{-- Task Title --}}
          <div class="mb-4">
              <label for="title">Task Title</label>
              <input type="text" name="title" value="{{ $task->title }}"
                  class="input @error('title') ring-red-500 @enderror">

              @error('title')
                  <p class="error">{{ $message }}</p>
              @enderror
          </div>
          

          {{-- Task Description --}}
          <div class="mb-4">
              <label for="descr">Task Description</label>
              <textarea name="descr" rows="4" class="input @error('descr') ring-red-500 @enderror">{{ $task->descr }}</textarea>

              @error('descr')
                  <p class="error">{{ $message }}</p>
              @enderror
          </div>

          {{-- Task Priority --}}
          <div class="mb-4">
            <label for="priority">Task Priority</label>
            <input type="text" name="priority" value="{{ $task->priority }}"
                class="input @error('priority') ring-red-500 @enderror">

            @error('priority')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>


         {{-- Task Chose Project --}}
         <div class="mb-4">
            <label for="project_id">Task Chose Project</label>

            <select  name="project_id" class="input @error('project_id') ring-red-500 @enderror" >
                <option value="" selected>None Project</option>
                @foreach ( $projects as $project)
                    @if ($task->project != NULL && $task->project->id == $project->id )
                        <option value="{{ $project->id }}" selected> {{ $project->title }} </option>
                    @else
                        <option value="{{ $project->id }}"> {{ $project->title }} </option>
                    @endif
                @endforeach

            </select>

            @error('project_id')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

            
          {{-- Submit Button --}}
          <button class="btn">Update Task</button>
      </form>
  </div>
</x-layout>