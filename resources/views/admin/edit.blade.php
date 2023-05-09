<x-layout>
    <div class="form col-md-6 offset-3 mb-5  ">
        
        <form action="" method="POST" enctype="multipart/form-data">
            <legend class="text-center h4">Profile Form</legend>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="" name="name" value="{{ old('name',Auth::user()->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('name',Auth::user()->user_name) }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleFormControlInput1" placeholder="name@example.com" value="{{ old('name',Auth::user()->email) }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Profile Photo</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label  class="control-label mb-1">Gender</label>
                <select name="gender"  class="form-control @error('gender') is-invalid @enderror" >
                    <option value="">Choose Gender</option>
                    <option value="male" @if (Auth::user()->gender=='male')
                                                selected
                                            @endif>Male</option>
                    <option value="female" @if (Auth::user()->gender=='female')
                                                selected
                                            @endif>Female</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label  class="control-label mb-1">Role</label>
                <input name="role" type="text" class="form-control" value="{{ Auth::user()->role }}" disabled>
            </div>

            <div class="mb-1 text-center">
                <button class="btn btn-dark col-4" type="submit">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-layout>
