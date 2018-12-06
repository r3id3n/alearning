<div class="col-md-4">
    <div class="card">
        {{-- __ Sirve para la traduccion de idiomas --}}
        <div class="card-header"> {{__("Socialite") }} </div>
        <div class="card-body">
            <a href="{{route('social_auth', ['driver' => 'github']) }}"
            class="btn btn-github btn-lg btn-block">
                {{ __("Github")}} <i class="fab fa-github-alt"></i>       
            </a>
        </div>
    </div>
</div>