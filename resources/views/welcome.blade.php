<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="form-group">
            <select data-placeholder="Select Category" style="width:350px; padding: 10px;" class="form-control" tabindex="5"  onchange="location = this.value;">
                <option value="">---- Select Category ----</option>
                @foreach ($categories as $category)
                        <option value = "{{route('productList', $category->slug)}}" {{!empty($slug) && $slug == $category->slug ? 'selected="selected"' : ''}}>{{$category->name}}</option>
                @endforeach
            </select>
            </div>
        </div>
        @if(session('error'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
        @endif
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
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($products))
                @foreach($products as $product)
                    <tr>
                        <td><img src="{{asset('/images/' . $product->photo)}}" width="100" /></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->category()->first()->name}}</td>
                        <td>{{$product->qty}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <form action="{{route('products.read', $product->slug)}}" method="GET" style="display: inline;">
                                <button class="btn btn-success btn-xs" title="View"><span class="fa fa-eye fa-fw" ></span></button>
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

</x-guest-layout>
