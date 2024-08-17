<x-layout>


  <br>
  <h4 style="text-align: center;"> Create New Project </h4>
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



    <form action="{{ route('projects.store') }}" method="POST"  >
      
        @csrf

        {{-- Project Title --}}
        <div class="mb-4">
          <label for="title"> Project Title </label>
          <input type="text" name="title" value="{{ old('title') }}" class="input
          @error('title') ring-red-500 @enderror">
          @error('title')
            <p class="error"> {{ $message }} </p>
          @enderror
        </div>

        {{-- Project Descr --}}
        <div class="mb-4">
          <label for="descr"> Project Description </label>
          <textarea name="descr" rows="10" class="input
          @error('descr') ring-red-500 @enderror"> {{ old('descr') }} </textarea>
          @error('descr')
            <p class="error"> {{ $message }} </p>
          @enderror
        </div>


        {{-- Submit Button --}}
        <button class="btn">Create New Project</button>

    </form>


    <br>
    <h4 style="text-align: center;"> List of Projects </h4>
    <br>


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
                        Name
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg> --}}
                    </div>
                </th>
                {{-- <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Description
                    </div>
                </th> --}}
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


            @foreach ( $projects as $project )
              
            
                <tr class="bg-gray-100 text-center border-b text-sm text-gray-600">
                    {{-- <td class="p-2 border-r">
                        <input type="checkbox">
                    </td> --}}
                    <td class="p-2 border-r">{{ $project->id }}</td>
                    <td class="p-2 border-r"> {{ $project->title }} </td>
                    {{-- <td class="p-2 border-r"> {{ Str::words( $project->descr, 15 )}} </td> --}}
                    <td class="p-2 border-r"> {{ $project->created_at->diffForHumans() }} </td>
                    <td>
                        <a href="{{ route('projects.show', $project) }}" class="bg-blue-400 p-1 text-white hover:shadow-lg text-xs font-thin">Show</a>
                    </td>
                    <td>
                      <a href="{{ route('projects.edit', $project) }}" class="bg-blue-500 p-1 text-white hover:shadow-lg text-xs font-thin">Edit</a>
                    </td>
                    <td>
                      <form action="{{ route('projects.destroy', $project) }}" method="POST">
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
  {{ $projects->links() }}
</div>







</x-layout>


