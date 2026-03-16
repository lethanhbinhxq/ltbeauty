<section>
    <header class="mb-4">
        <h2 class="h5 font-weight-bold mb-1">
            {{ __('Update Password') }}
        </h2>

        <p class="text-muted mb-0">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password">
                {{ __('Current Password') }}
            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="form-control"
                autocomplete="current-password"
            >

            @if ($errors->updatePassword->get('current_password'))
                <small class="text-danger d-block mt-2">
                    {{ $errors->updatePassword->first('current_password') }}
                </small>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password">
                {{ __('New Password') }}
            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                class="form-control"
                autocomplete="new-password"
            >

            @if ($errors->updatePassword->get('password'))
                <small class="text-danger d-block mt-2">
                    {{ $errors->updatePassword->first('password') }}
                </small>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">
                {{ __('Confirm Password') }}
            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-control"
                autocomplete="new-password"
            >

            @if ($errors->updatePassword->get('password_confirmation'))
                <small class="text-danger d-block mt-2">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </small>
            @endif
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success ml-3"
                >
                    {{ __('Saved.') }}
                </span>
            @endif
        </div>
    </form>
</section>