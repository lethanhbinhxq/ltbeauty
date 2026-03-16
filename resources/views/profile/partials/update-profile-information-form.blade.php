<section>
    <header class="mb-4">
        <h2 class="h5 font-weight-bold mb-1">
            {{ __('Profile Information') }}
        </h2>
        <p class="text-muted mb-0">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                class="form-control"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <small class="text-danger d-block mt-2">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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