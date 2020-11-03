<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
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
                    <form name="edit-category-form" id="edit-category-form" method="post" action="{{route('categories.update', $category->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="name" name="name" class="form-control" required="" min="3" max="50" value="{{old('name') ??  $category->name}}">
                            @if($errors->has('name'))
                                <div class="text-red-500">{{ $errors->first('name') }}</div>
                            @endif                        
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control" required="" min="3" max="50" value="{{old('slug') ??  $category->slug}}">
                            @if($errors->has('slug'))
                                <div class="text-red-500">{{ $errors->first('slug') }}</div>
                            @endif                        
                        </div>
                        
                        <div class="form-group">
                            Active  &nbsp;&nbsp;
                            <input type="checkbox" name="is_active" class="switch-input" value="1" {{ old('is_active') || (!old('name') && $category->is_active) ? 'checked="checked"' : '' }}/>
                        
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