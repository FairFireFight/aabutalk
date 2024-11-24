@if ($paginator->hasPages())
    <nav class="btn-group" role="navigation" aria-label="Pagination Navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="btn btn-lg btn-outline-aabu pt-0 pb-1 px-4 rounded-start-pill disabled border-end-0" aria-disabled="true">
                &laquo;
            </span>
        @else
            <a class="btn btn-lg btn-outline-aabu pt-0 pb-1 px-4 rounded-start-pill border-end-0" href="{{ $paginator->previousPageUrl() }}">
                &laquo;
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="btn btn-lg btn-outline-aabu pt-0 pb-1 px-4 rounded-end-pill" href="{{ $paginator->nextPageUrl() }}">
                &raquo;
            </a>
        @else
            <span class="btn btn-lg btn-outline-aabu pt-0 pb-1 px-4 rounded-end-pill disabled" aria-disabled="true">
                &raquo;
            </span>
        @endif
    </nav>
@endif
