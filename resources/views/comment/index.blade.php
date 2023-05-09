<x-layout>
    <div class="detail">

        <div class="recentOrders">
            <div class="cardHeaders">
                <h3>Courses with Comments - {{ $courses->total() }}</h3>
            </div>

            @if (count($courses) != 0)
                <table>
                    <thead>
                        <tr>
                            <td>Image</td>
                            <td>Title</td>
                            <td>Instructor</td>
                            <td>Subject</td>
                            <td>Total</td>
                            <td>Comments</td>
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
                                <td class="col-3">{{ $course->category->name }}</td>
                                <td class="col-1">{{ $course->comments_count }}</td>
                                <td class="">
                                    <a href="{{ route('comment',$course->id) }}" class="btn btn-outline-dark btn-sm">View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $courses->links() }}
            @else
                <h1 class="text-center text-secondary mt-5">There is no Courses and Comments to show Here!</h1>
            @endif
        </div>
    </div>
</x-layout>
