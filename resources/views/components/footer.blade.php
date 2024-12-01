<footer class="py-3 border-top">
    <div class="row text-body-secondary">
        <div class="col-md d-flex flex-column">
            <h5><a href="{{ getLocaleURL('/') }}">AABU Talk</a></h5>
            <h6>{{ __('footer.slogan') }}</h6>
            <p class="mt-auto mb-0">&copy; 2024, {{ __('footer.rights_reserved') }}</p>
        </div>
        <div class="col-md d-flex flex-column">
            <p>&copy; {{ __('footer.logo_copy') }}</p>
            <div class="mt-auto">
                <a href="#" class="me-4">{{ __('footer.to_top') }}</a>
                @guest
                    <a href="{{ getLocaleSwitchURL() }}">
                        <i class="bi bi-globe me-2"></i>{{ __('common.language') }}
                    </a>
                @endguest
            </div>

        </div>
    </div>
</footer>
