<?php 


use Illuminate\Support\Facades\Session;


?>

<x-layout>



  <br>
  <h4 style="text-align: center;"> Create New Task </h4>
  <br>

  <div class="table w-full p-2">


    {{-- Session Messages --}}
    @if (session('success'))
    
        <x-flashMsg msg="{{ session('success') }}" />

    @elseif( session('delete') )
      
        <x-flashMsg msg="{{ session('delete') }}"  />
    @elseif( session('error') )
      
        <x-flashMsg msg="{{ session('error') }}" bg="bg-red-500" />
        
    @endif



    <form action="{{ route('tasks.store') }}" method="POST"  >
      
        @csrf

        {{-- Task Title --}}
        <div class="mb-4">
          <label for="title"> Task Title </label>
          <input type="text" name="title" value="{{ old('title') }}" class="input
          @error('title') ring-red-500 @enderror">
          @error('title')
            <p class="error"> {{ $message }} </p>
          @enderror
        </div>

        {{-- Task Descr --}}
        <div class="mb-4">
          <label for="descr"> Task Description </label>
          <textarea name="descr" rows="10" class="input
          @error('descr') ring-red-500 @enderror"> {{ old('descr') }} </textarea>
          @error('descr')
            <p class="error"> {{ $message }} </p>
          @enderror
        </div>

        <div class="mb-4">
            <label for="priority">Task Priority</label>
            <input type="text" name="priority" value=""
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
                    <option value="{{ $project->id }}"> {{ $project->title }} </option>
                @endforeach

            </select>

            @error('project_id')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        


        {{-- Submit Button --}}
        <button class="btn">Create New Task</button>

    </form>



    <br><br>
    <h4 style="text-align: center;"> List of Tasks </h4>
    <br><br>



    <form action="{{ route('tasks.project') }}" method="GET">

        {{-- @csrf --}}
        {{-- @method('GET') --}}
        <label for="project_id">Filter Tasks By Project</label>
        <br>
        <select name="project_id" id="project_id">
            
            <option value="all" selected>All Tasks </option>

            @if ( (isset( $project_id ) && $project_id == "null") || ( Session::has('tasks_project_id')  &&  Session::get('tasks_project_id') == "null" ) )
                <option value="null" selected>Tasks Without Project</option>
            @else
                <option value="null">Tasks Without Project</option>
            @endif
            

            @foreach ( $projects as $project)
                
                @if ( (isset( $project_id ) && $project_id == $project->id) || ( Session::has('tasks_project_id')  &&  Session::get('tasks_project_id') == $project->id) )
                    <option value="{{ $project->id }}" selected> {{ $project->title }} </option>
                @else
                    <option value="{{ $project->id }}"> {{ $project->title }} </option>
                @endif
            @endforeach


        </select>

        <button type="submit" class="bg-blue-400 p-3 text-white hover:shadow-lg text-xs font-thin"> Apply Filter </button>

    </form>


  <div class="table w-full p-2">
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-50 border-b">
                {{-- <th class="border-r p-2">
                    <input type="checkbox">
                </th> --}}
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        ID
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg> --}}
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Title
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg> --}}
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                  <div class="flex items-center justify-center">
                        Project Title
                      {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                      </svg> --}}
                  </div>
              </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Priority
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Created At
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg> --}}
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Show
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg> --}}
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Edit
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg> --}}
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Delete
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg> --}}
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
{{--           
            <tr class="bg-gray-50 text-center">
                <td class="p-2 border-r">
                    
                </td>
                <td class="p-2 border-r">
                    <input type="text" class="border p-1">
                </td>
                <td class="p-2 border-r">
                    <input type="text" class="border p-1">
                </td>
                <td class="p-2 border-r">
                    <input type="text" class="border p-1">
                </td>
                <td class="p-2 border-r">
                    <input type="text" class="border p-1">
                </td>
                <td class="p-2">
                    <input type="text" class="border p-1">
                </td>
                
                
            </tr> --}}


            @foreach ( $tasks as $task )
              
            
                <tr class="bg-gray-100 text-center border-b text-sm text-gray-600">
                    {{-- <td class="p-2 border-r">
                        <input type="checkbox">
                    </td> --}}
                    <td class="p-2 border-r">{{ $task->id }}</td>
                    <td class="p-2 border-r"> {{ $task->title }} </td>
                    @if ( $task->project != NULL )
                      <td class="p-2 border-r"> <a href="{{ route('projects.show', $task->project ) }}">  {{ $task->project->title }} </a> </td>
                    @else  
                      <td class="p-2 border-r"> / </td>
                    @endif

                    {{-- <td class="p-2 border-r"> {{ Str::words( $task->descr, 15 )}} </td> --}}
                    <td class="p-2 border-r"> {{ $task->priority }} </td>
                    <td class="p-2 border-r"> {{ $task->created_at->diffForHumans() }} </td>
                    <td>
                        <a href="{{ route('tasks.show', $task) }}" class="bg-blue-400 p-1 text-white hover:shadow-lg text-xs font-thin">Show</a>
                    </td>
                    <td>
                      <a href="{{ route('tasks.edit', $task) }}" class="bg-blue-500 p-1 text-white hover:shadow-lg text-xs font-thin">Edit</a>
                    </td>
                    <td>
                      <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 p-1 text-white hover:shadow-lg text-xs font-thin"> Delete</button>
                        </form>
                    </td>
                </tr>

            @endforeach


        </tbody>
    </table>

</div>


<div>
  {{ $tasks->links() }}
</div>







</x-layout>


