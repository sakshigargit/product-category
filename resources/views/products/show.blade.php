<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="card">
                <div class="card-body">
                    <table class='table table-striped table-responsive'>
                        <tr>
                            <th>
                                Name
                            </th>
                            <td>
                                {{$product->name}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Image
                            </th>
                            <td>
                                
                                <img src="{{asset('/images/' . $product->photo)}}" width='500' />
                            </td>
                        </tr>
                    <tr> <th>Description</th> <td> {{$product->description}} </td>  </tr>
                    <tr> <th>Category</th> <td> {{$product->category()->first()->name}} </td>  </tr>
                    <tr> <th>Quantity</th> <td> {{$product->qty}} </td>  </tr>
                    <tr> <th>Price</th> <td> {{$product->price}} </td>  </tr>
                    <tr> <th>Added on</th> <td> {{$product->created_at}} </td>  </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>