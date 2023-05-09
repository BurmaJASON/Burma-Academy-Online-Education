@if(request()->routeIs('dashboard'))
    <div class="recentCustomers">
        <div class="cardHeaders">
            <h3>Recent Students</h3>
        </div>

        <table>
            @if (count($students) != 0)
                @foreach ($students as $student)
                    <tr>
                        <td width="60px">
                            <div class="imgBx">
                                @if($student->image == null)
                                    <img src="{{ asset('assets/imgs/abstract-user-flat-4.png') }}" alt="">
                                @else
                                    <img src="{{ asset('storage/profileImage/'.$student->image) }}" alt="">
                                @endif
                            </div>
                        </td>
                        <td>
                            <h4>{{ $student->user_name }} <br> <span>{{ $student->email }}</span></h4>
                        </td>
                    </tr>
                @endforeach
            @else
                <h1 class="text-center text-secondary mt-5">Noone yet!</h1>
            @endif
        </table>
    </div>

@elseif(request()->routeIs('category'))
    <div class="category">
        <form action="{{ route('category#create') }}" method="POST">
            @csrf
            <legend class="text-center text-secondary h4">Create Form</legend>
            <div class="mb-3">
                <label for="title" class="form-label">Subject Name</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Subject Title.." name="title" value="{{ old('title') }}">
                @error('title')
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
@elseif($category->slug != null)
        <div class="category">
            <form action="{{ route('category#update',$category->id) }}" method="POST">
                @csrf
                <legend class="text-center text-secondary h4">Edit Form</legend>
                <div class="mb-3">
                    <label for="title" class="form-label">Subject Name</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Subject Title.." name="title" value="{{ old('title',$category->name) }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-1 text-center">
                    <button class="btn btn-dark col-4" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
@endif

