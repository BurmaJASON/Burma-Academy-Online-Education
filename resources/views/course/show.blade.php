<x-layout>
    <a href="" class="btn btn-primary ms-4" onclick="history.back()">Back</a>
    <div class="card col-6 offset-3 my-5">
        @if ($course->image == null)
            <img src="{{ asset('assets/imgs/default.jpeg') }}" class="card-img-top " alt="">
        @else
            <img src="{{ asset('storage/courseImage/'.$course->image) }}" class="card-img-top " alt="">
        @endif
        <div class="card-body">
          <h5 class="card-title text-center">{{ $course->title }}</h5>
          <div class=" my-2 btn btn-outline-info d-block">
            <span class="mx-3">View - {{ $course->view_count }}</span>
            <span class="mx-3">Fee - ${{ $course->price }}</span>
          </div>
          <span class="h6">#{{ $course->category->name }}</span>

          <p class="text-muted">Instructor - {{ $course->instructor->user_name }}</p>
          <p class="h6">Intro</p>
          <p class="card-text">{{ $course->intro }}</p>
          <p class="h6">Details</p>
          <p class="card-text">{!! $course->body !!}</p>
          <a href="{{ route('course#edit',$course->slug) }}" class="btn btn-secondary">Edit Course</a>
        </div>
        <div class="card-footer">
            <small class="text-muted">Last updated {{ $course->updated_at->diffForHumans() }}</small>
        </div>
    </div>
</x-layout>
