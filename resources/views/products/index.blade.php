<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
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
                <a href="{{route('products.create')}}">
                <button class="btn btn-success">Create Product</button>
                </a>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description </th>
                        <th>Category </th>
                        <th>Quantity </th>
                        <th>Price </th>
                        <th>Created By </th>
                        <th>Updated By </th>
                        <th>Active </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($products))
                @foreach($products as $product)
                    <tr>
                        <td><img src="{{asset('/images/' . $product->photo)}}" width="50" /></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->category()->first()->name}}</td>
                        <td>{{$product->qty}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->createdBy()->first()->name}}</td>
                        <td>{{$product->updatedBy()->first()->name}}</td>
                        <td>{{$product->is_active ? 'Yes' : 'No'}}</td>
                        <td>
                            <form action="{{route('products.edit', $product->id)}}" method="GET" style="display: inline;">
                                <button class="btn btn-success btn-xs" title="Edit"><span class="fa fa-pencil fa-fw" ></span></button>
                            </form>
                            <form action="{{route('products.destroy', $product->id)}}" method="POST" style="display: inline;">
                               {{csrf_field()}}
                               {{method_field('DELETE')}}
                                <button class="btn btn-danger btn-xs delete" title="Delete"><span class="fa fa-fw fa-trash"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="10">
                            No Record Found
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $products->links() }}
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
