<div class="cardBox">
    <a href="{{ route('course') }}" class="text-decoration-none">
        <div class="cards">
            <div>
                <div class="numbers">{{ $views }}</div>
                <div class="cardName">Views</div>
            </div>

            <div class="iconBx">
                <ion-icon name="eye-outline"></ion-icon>
            </div>
        </div>
    </a>


    <a href="{{ route('course') }}" class="text-decoration-none">
        <div class="cards">
            <div>
                <div class="numbers">{{ $courses->count() }}</div>
                <div class="cardName ">Courses</div>

            </div>

            <div class="iconBx">
                <ion-icon name="cart-outline"></ion-icon>
            </div>
        </div>
    </a>

    <a href="{{ route('comments') }}" class="text-decoration-none">
        <div class="cards">
            <div>
                <div class="numbers">{{ $comments }}</div>
                <div class="cardName">Comments</div>
            </div>

            <div class="iconBx">
                <ion-icon name="chatbubbles-outline"></ion-icon>
            </div>
        </div>
    </a>

    <a href="{{ route('course') }}" class="text-decoration-none">
        <div class="cards">
            <div>
                <div class="numbers">${{ $earning }}</div>
                <div class="cardName">Earning</div>
            </div>

            <div class="iconBx">
                <ion-icon name="cash-outline"></ion-icon>
            </div>
        </div>
    </a>
</div>
