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
                    <form name="add-product-form" id="add-product-form" method="post" action="{{route('categories.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
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