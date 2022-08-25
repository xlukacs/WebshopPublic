<!-- Modal -->
<section class="modal fade" id="loginPopup" tabindex="-1" role="dialog" aria-labelledby="loginPopup" aria-hidden="true">
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
                                    <p>Log in</p>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <!-- Email Address -->
                                        <div>
                                            <x-label for="email" :value="__('Email')" />

                                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-label for="password" :value="__('Password')" />

                                            <x-input id="password" class="block mt-1 w-full"
                                                            type="password"
                                                            name="password"
                                                            required autocomplete="current-password" />
                                        </div>
                                        <x-button class="ml-3">
                                            {{ __('Log in') }}
                                        </x-button>
                                        <div class="facebookButton socialButton" onclick="window.location.href = '/profile';">Log in with Facebook</div>
                                        <div class="twitterButton socialButton" onclick="window.location.href = '/profile';">Log in with Twitter</div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center" id="popupModeChanger">
                                    <a href="#" type="button" data-toggle="modal" data-target="#registerPopup" {{--onclick="document.getElementById('loginPopup').style.display = 'none'"--}}>No account? Register here!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>