<x-layout>

  <a href="{{ route('projects.index') }}" class="block mb-2 text-xs text-blue-500">&larr; Go back to your Project List </a>

  {{-- Update form card --}}
  <div class="card">
      <h2 class="font-bold mb-4">Update your Project</h2>

      <form action="{{ route('projects.update', $project) }}" method="post" >
          @csrf
          @method('PUT')

          {{-- Project Title --}}
          <div class="mb-4">
              <label for="title">Project Title</label>
              <input type="text" name="title" value="{{ $project->title }}"
                  class="input @error('title') ring-red-500 @enderror">

              @error('title')
                  <p class="error">{{ $message }}</p>
              @enderror
          </div>

          {{-- Project Description --}}
          <div class="mb-4">
              <label for="descr">Project Description</label>
              <textarea name="descr" rows="4" class="input @error('descr') ring-red-500 @enderror">{{ $project->descr }}</textarea>

              @error('descr')
                  <p class="error">{{ $message }}</p>
              @enderror
          </div>

          {{-- Submit Button --}}
          <button class="btn">Update Project</button>
      </form>
  </div>
</x-layout>