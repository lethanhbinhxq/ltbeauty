<section>
    <header class="mb-4">
        <h2 class="h5 font-weight-bold text-danger mb-1">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-muted mb-0">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteAccountModal">
        {{ __('Delete Account') }}
    </button>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <p class="text-muted">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="{{ __('Password') }}"
                            >

                            @if ($errors->userDeletion->get('password'))
                                <small class="text-danger d-block mt-2">
                                    {{ $errors->userDeletion->first('password') }}
                                </small>
                            @endif
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>

                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete Account') }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>