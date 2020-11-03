<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session('status'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-right">
                <a href="{{route('categories.create')}}">
                <button class="btn btn-success">Create Category</button>
                </a>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="table table-responsive table-striped">
               <thead>
                  <tr>
                     
                     <th>Name</th>
                     <th>Slug</th>
                     <th>Active </th>
                     <th>Created Date </th>
                     <th>Updated Date </th>
                     <th>Action</th>
                  </tr>
               </thead>
               @if (count($categories))
               @foreach($categories as $category)
               <tbody>
                  <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->is_active ? 'Yes' : 'No'}}</td>
                        <td>{{$category->created_at}}</td>
                        <td>{{$category->updated_at}}</td>
                        <td>
                            <a href="{{route('categories.edit', $category->id)}}"><button class="btn btn-success btn-xs" title="Edit"><span class="fa fa-pencil fa-fw"></span></button></a>
                            <form action="{{route('categories.destroy', $category->id)}}" method="POST" style='display: inline'>
                               {{csrf_field()}}
                               {{method_field('DELETE')}}
                               <button class="btn btn-danger btn-xs" title="Delete"><span class="fa fa-fw fa-trash"></span></button>
                               
                            </form>
                        </td>
                  </tr>
               </tbody>
               @endforeach
               @else
                    <tr>
                        <td colspan="4">
                            No Record Found
                        </td>
                    </tr>
               @endif
               </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
    @push('scripts')
    <script>
        $(".delete").on("click", function(){
            return confirm("Are you sure you want to delete this product?");
        });
    </script>
    @endpush
</x-app-layout>
