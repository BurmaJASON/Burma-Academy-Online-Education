<x-layout>
    <div class="detail">

        <div class="recentOrders">
            <div class="cardHeaders">
                <h3>Total - {{ $all->total() }}</h3>
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ isset($currentRole) ? $currentRole : 'Filter By Role' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="{{ route('list') }}">All</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('show','Admin') }}">Admin</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('show','User') }}">User</a>
                        </li>
                    </ul>
                </div>
            </div>

            @if (count($all) != 0)
                <table>
                    <thead>
                        <tr>
                            <td>Image</td>
                            <td>User Name</td>
                            <td>Email</td>
                            <td>Role</td>
                            <td>Joined Date</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($all as $index => $each)
                            <tr>
                                <td class="col-1">
                                    @if ($each->image == null)
                                        <img src="{{ asset('assets/imgs/abstract-user-flat-4.png') }}" class="rounded w-100 shadow-sm" alt="">
                                    @else
                                        <img src="{{ asset('storage/profileImage/'.$each->image) }}" class="rounded w-100 shadow-sm" alt="">
                                    @endif
                                </td>
                                <td class="">{{ $each->user_name }}</td>
                                <td  class="">{{ $each->email }}</td>
                                <td  class="">{{ $each->role }}</td>
                                <td  class="">{{ $each->created_at->diffForHumans() }}</td>
                                <td class="">
                                    @if ($each->id == Auth()->user()->id)

                                    @else
                                        @if ($each->role == 'Admin')
                                            <form action="{{ route('update',$each->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit"  class="btn btn-link-primary" title="Change Role to Admin">
                                                    <ion-icon name="person-remove"></ion-icon>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('update',$each->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-link-primary" title="Change Role to User">
                                                    <ion-icon name="person-add"></ion-icon>
                                                </button>
                                            </form>
                                        @endif
                                            <form action="{{ route('delete',$each->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-link-primary">
                                                    <ion-icon name="trash"></ion-icon>
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
                <h1 class="text-center text-secondary mt-5">There is Noone Here!</h1>
            @endif
        </div>
    </div>
</x-layout>
