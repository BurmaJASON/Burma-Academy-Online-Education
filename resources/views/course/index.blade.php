<x-layout>
    <div class="detail">

        <div class="recentOrders">
            <div class="cardHeaders">
                <h3>All Courses - {{ $courses->total() }}</h3>
                <a href="createCourse" class="btn">Create Course</a>
            </div>

            @if (count($courses) != 0)
                <table>
                    <thead>
                        <tr>
                            <td>Image</td>
                            <td>Title</td>
                            <td>Instructor</td>
                            <td>Subject</td>
                            <td>Price</td>
                            <td>Views</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($courses as $index => $course)
                            <tr>
                                <td class="col-1">
                                    @if ($course->image == null)
                                        <img src="{{ asset('assets/imgs/default.jpeg') }}" class="rounded w-100 shadow-sm" alt="">
                                    @else
                                        <img src="{{ asset('storage/courseImage/'.$course->image) }}" class="rounded w-100 shadow-sm" alt="">
                                    @endif
                                </td>
                                <td class="col-3">{{ $course->title }}</td>
                                <td  class="col-2">{{ $course->instructor->user_name }}</td>
                                <td  class="col-3">{{ $course->category->name }}</td>
                                <td  class="col-1">${{ $course->price }}</td>
                                <td  class="col-1">{{ $course->view_count }}</td>
                                <td class="col-1">
                                    <a href="{{ route('course#show',$course->slug) }}" class="btn btn-link-primary">
                                        <ion-icon name="eye"></ion-icon>
                                    </a>
                                    <form action="{{ route('course#delete',$course->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-link-primary">
                                            <ion-icon name="trash"></ion-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $courses->links() }}
            @else
                <h1 class="text-center text-secondary mt-5">There is no Course Here!</h1>
            @endif
        </div>
    </div>
</x-layout>
