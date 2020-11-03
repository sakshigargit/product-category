<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form name="add-product-form" id="add-product-form" method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="name" name="name" class="form-control" required="" min="3" max="50" value="{{old('name')}}">
                            @if($errors->has('name'))
                                <div class="text-red-500">{{ $errors->first('name') }}</div>
                            @endif                        
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control" required="" min="3" max="50" value="{{old('slug')}}">
                            @if($errors->has('slug'))
                                <div class="text-red-500">{{ $errors->first('slug') }}</div>
                            @endif                        
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required="" min="5">{{old('description')}}</textarea>
                            @if($errors->has('description'))
                                <div class="text-red-500">{{ $errors->first('description') }}</div>
                            @endif                        
                        </div>

                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" id="qty" name="qty" class="form-control" required="" value="{{old('qty')}}" min="1">
                            @if($errors->has('qty'))
                                <div class="text-red-500">{{ str_replace('Qty', 'Quantity', str_replace('qty', 'quantity', $errors->first('qty'))) }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" id="price" name="price" class="form-control" required="" step=".01" value="{{old('price')}}" min="1">
                            @if($errors->has('price'))
                                <div class="text-red-500">{{ $errors->first('price') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="title">Category</label>
                            <select name="category_id" id="Instructorid" class="form-control" required="">
                                    <option value="">--- Select Category ---</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected="selected"' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                            @if($errors->has('category_id'))
                                <div class="text-red-500">{{ $errors->first('category_id') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image">Choose Image</label>
                            <input id="image" type="file" name="image">
                            @if($errors->has('image'))
                                <div class="text-red-500">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            Active  &nbsp;&nbsp;
                            <input type="checkbox" name="is_active" class="switch-input" value="1" {{ old('is_active') || (!old('name')) ? 'checked="checked"' : '' }}/>
                        
                            @if($errors->has('is_active'))
                                <div class="text-red-500">{{ $errors->first('is_active') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $("#name").on('keyup', function(){
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
                $("#slug").val(Text);        
        });
    </script>
    @endpush
</x-app-layout>