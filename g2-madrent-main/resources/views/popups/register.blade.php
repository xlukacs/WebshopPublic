<!-- Modal -->
<section class="modal fade" id="registerPopup" tabindex="-1" role="dialog" aria-labelledby="registerPopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col flex-column text-center">
                            <img src="/images/logoPic.png" alt="Placeholder">
                            <h1>{{ config('app.title') }}</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container-fluid" id="authWrapper">
                            <div class="row">
                                <div class="col">
                                     <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                    
                                    <p>Register</p>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <!-- Name -->
                                        <div>
                                            <x-label for="name" :value="__('Name')" />

                                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                        </div>
                                        <!-- Email Address -->
                                        <div class="mt-4">
                                            <x-label for="email" :value="__('Email')" />

                                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                        </div>
                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-label for="password" :value="__('Password')" />

                                            <x-input id="password" class="block mt-1 w-full"
                                                            type="password"
                                                            name="password"
                                                            required autocomplete="new-password" />
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mt-4">
                                            <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                                            type="password"
                                                            name="password_confirmation" required />
                                        </div>
                                        <x-button class="ml-4">
                                            {{ __('Register') }}
                                        </x-button>
                                        <div class="facebookButton socialButton" onclick="window.location.href = '/profile';">Register with Facebook</div>
                                        <div class="twitterButton socialButton" onclick="window.location.href = '/profile';">Register with Twitter</div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center" id="popupModeChanger">
                                    <a href="#" type="button" data-toggle="modal" data-target="#loginPopup">Allready have an account? <br/> Log in!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>