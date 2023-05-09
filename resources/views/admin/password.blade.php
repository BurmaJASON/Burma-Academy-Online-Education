<x-layout>
    <div class="form mb-5 col-6 offset-3 mt-5 ">
        @if (session('passUpdateFail'))
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('passUpdateFail') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif
        <form action="{{ route('password#change') }}" method="POST" >
            @csrf
            <legend class="text-center">Password Change Form</legend>
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" class="form-control @error('currentPassword') is-invalid @enderror" id="currentPassword" required placeholder="Enter old password.." name="currentPassword" >
                @error('currentPassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" required placeholder="Enter new password.." name="newPassword">
                @error('newPassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirmPassword" required placeholder="Enter new password.." name="confirmPassword">
                @error('confirmPassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-1 text-center">
                <button class="btn btn-dark col-4" type="submit">
                    Update <i class="fa-solid fa-circle-chevron-right ms-1"></i>
                </button>
            </div>
        </form>
    </div>
</x-layout>
