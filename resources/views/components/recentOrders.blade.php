<div class="recentOrders">
    @if(request()->routeIs('dashboard'))
        <div class="cardHeaders">
            <h3>Recent Enrollments</h3>
            <a href="{{ route('enrollments') }}" class="btn">View All</a>
        </div>

        <table>
            @if (count($enrollments) != 0)
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Course</td>
                    <td>Price</td>
                    <td>Status</td>
                </tr>
            </thead>

            <tbody>

                @foreach ($enrollments as $enrollment)

                    <tr>
                        <td>{{ $enrollment->user->user_name }}</td>
                        <td>{{ $enrollment->course->title }}</td>
                        <td>${{ $enrollment->course->price }}</td>
                        <td>
                            @if ($enrollment->status == 0)
                                <span class="status pending">Pending</span>
                            @elseif ($enrollment->status == 1)
                                <span class="status delivered">Accepted</span>
                            @else
                                <span class="status return">Rejected</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <h1 class="text-center text-secondary mt-5">No Enrollments yet!</h1>
            @endif
            </tbody>
        </table>

    @else
    {{-- (request()->routeIs('category')) --}}
        <div class="cardHeaders">
            <h3>All Categories - {{ $categories->count() }}</h3>
        </div>
        <table>
            @if (count($categories) != 0)

                <thead>
                    <tr>
                        <td>No</td>
                        <td>Name</td>
                        <td>Date</td>
                        <td></td>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($categories as $index => $category)

                        <tr>
                            <td>{{ $index +1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->updated_at->diffForHumans() }}</td>
                            <td>
                                <a href="/category/{{ $category->slug }}" class="btn btn-link-primary">
                                    <ion-icon name="create"></ion-icon>
                                </a>
                                <form action="{{ route('category#delete',$category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link-primary">
                                        <ion-icon name="trash"></ion-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h1 class="text-center text-secondary mt-5">No Subjects yet!</h1>
                @endif
                </tbody>
        </table>
    @endif
</div>
