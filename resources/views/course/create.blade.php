<x-layout>
    <a href="" class="btn btn-primary ms-4" onclick="history.back()">Back</a>

    <div class="form col-md-6 offset-3 mb-5  ">
        <form action="{{ route('course#create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <legend class="text-center h4">Course Form</legend>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Course Title.." name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label  class="control-label mb-1">Subject</label>
                <select name="category"  class="form-control @error('category') is-invalid @enderror" >
                    <option value="">Choose Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="intro" class="form-label">Course Intro</label>
                <textarea type="text" class="form-control @error('intro') is-invalid @enderror" id="intro" placeholder="Enter course intro.." name="intro"  >{{ old('intro') }}</textarea>
                @error('intro')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Course Detail</label>
                <textarea id="editor" type="text" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror"  placeholder="Enter overall course info.." name="body">{{ old('body') }}</textarea>
                @error('body')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Default Course price would be FREE!" name="price" value="{{ old('price') }}">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Course Thumbnail</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">

                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-1 text-center">
                <button class="btn btn-dark col-4" type="submit">
                    Create
                </button>
            </div>
        </form>
    </div>
</x-layout>

