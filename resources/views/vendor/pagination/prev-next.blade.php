@if ($paginator->hasPages())
    <nav class="pagination-wrapper">
        <ul class="pagination justify-content-center align-items-center">

            {{-- Previous Button --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link"
                   href="{{ $paginator->previousPageUrl() ?? '#' }}">
                    ‹ Previous
                </a>
            </li>

            {{-- Page Indicator --}}
            <li class="page-item disabled">
                <span class="page-link bg-light border-0">
                    {{ $paginator->currentPage() }}
                    /
                    {{ $paginator->lastPage() }}
                </span>
            </li>

            {{-- Next Button --}}
            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link"
                   href="{{ $paginator->nextPageUrl() ?? '#' }}">
                    Next ›
                </a>
            </li>

        </ul>
    </nav>
@endif
