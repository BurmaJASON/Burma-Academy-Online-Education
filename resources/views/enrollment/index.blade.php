<x-layout>
    <div class="detail">

        <div class="recentOrders">
            <div class="cardHeaders">
                <h3>Total - {{ $all->total() }}</h3>
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ isset($currentStatus) ? $currentStatus : 'Filter By Status' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="{{ route('enrollments') }}">All</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('enrollment',0) }}">Pending</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('enrollment',1) }}">Accepted</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('enrollment',2) }}">Rejected</a>
                        </li>

                    </ul>
                </div>
            </div>

            @if (count($all) != 0)
                <table>
                    <thead>
                        <tr>
                            <td>Image</td>
                            <td>Student</td>
                            <td>Course</td>
                            <td>Status</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($all as $index => $each)
                            <tr>
                                <td class="col-1">
                                    @if ($each->course->image == null)
                                        <img src="{{ asset('assets/imgs/default.jpeg') }}" class="rounded w-100 shadow-sm" alt="">
                                    @else
                                        <img src="{{ asset('storage/courseImage/'.$each->course->image) }}" class="rounded w-100 shadow-sm" alt="">
                                    @endif
                                </td>
                                <td class="">{{ $each->user->user_name }}</td>
                                <td  class="">{{ $each->course->title }}</td>
                                <td  class="">
                                    @if ($each->status == 0)
                                        <span class="status pending">Pending</span>
                                    @elseif ($each->status == 1)
                                        <span class="status delivered">Accepted</span>
                                    @else
                                        <span class="status return">Rejected</span>
                                    @endif
                                </td>
                                <td class="">
                                    @if ($each->status != 0)

                                    @else
                                        <form action="{{ route('accept',$each->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-link-primary" title="Accept">
                                                <ion-icon name="checkmark-circle"></ion-icon>
                                            </button>
                                        </form>
                                    <form action="{{ route('reject',$each->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-link-primary" title="Reject">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $all->links() }}
            @else
                <h1 class="text-center text-secondary mt-5">There is No Enrollment Here!</h1>
            @endif
        </div>
    </div>
</x-layout>
