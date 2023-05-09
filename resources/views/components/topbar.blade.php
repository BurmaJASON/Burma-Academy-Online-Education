<div class="topbar">
    <div class="toggle">
        <ion-icon name="menu-outline"></ion-icon>
    </div>

    @if(request()->routeIs('course'))
        <div class="search">
            <form action="">
                <label>
                    <input type="text" name="search"  placeholder="Search courses here.." class="ms-1" value="{{ request('search') }}">
                    <ion-icon name="search-outline" class="mt-2 p-1"></ion-icon>
                </label>
            </form>
        </div>
    @elseif(request()->routeIs('category'))
        <div class="search">
            <form action="">
                <label>
                    <input type="text" name="search" placeholder="Search category here.." value="{{ request('search') }}" class="ms-1">
                    <ion-icon name="search-outline" class="mt-2 p-1"></ion-icon>
                </label>
            </form>
        </div>
    @elseif(request()->routeIs('list') || request()->routeIs('show') )
        <div class="search">
            <form action="">
                <label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search insturctors and students here.." class="ms-1">
                    <ion-icon name="search-outline" class="mt-2 p-1"></ion-icon>
                </label>
            </form>
        </div>
    @elseif(request()->routeIs('enrollments') || request()->routeIs('enrollment') )
        <div class="search">
            <form action="">
                <label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search enrollments here.." class="ms-1">
                    <ion-icon name="search-outline" class="mt-2 p-1"></ion-icon>
                </label>
            </form>
        </div>
    @elseif(request()->routeIs('comments'))
        <div class="search">
            <form action="">
                <label>
                    <input type="text" name="search" placeholder="Search courses here.." value="{{ request('search') }}" class="ms-1">
                    <ion-icon name="search-outline" class="mt-2 p-1"></ion-icon>
                </label>
            </form>
        </div>
    @elseif(request()->routeIs('comment'))
        <div class="search">
            <form action="">
                <label>
                    <input type="text" name="search" placeholder="Search comments here.." value="{{ request('search') }}" class="ms-1">
                    <ion-icon name="search-outline" class="mt-2 p-1"></ion-icon>
                </label>
            </form>
        </div>
    @else
        <h2 class="text-muted">{{ auth()->user()->user_name }}'s Dashboard</h2>
    @endif

    <div class="user">
        <a href="{{ route('profile#edit') }}">
            @if(Auth::user()->image == null)
                <img src="{{ asset('assets/imgs/abstract-user-flat-4.png') }}" alt="Admin Profile" title="Admin Profile">
            @else
                <img src="{{ asset('storage/profileImage/'.Auth()->user()->image) }}" alt="Admin Profile" title="Admin Profile">
            @endif
        </a>
    </div>
</div>
