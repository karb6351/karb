@if ($paginator->hasPages())
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        @if ($paginator->onFirstPage())
            <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" disabled>Previous</a>
        @else
            <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
        @endif
        <ul class="pagination-list">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="pagination-link is-current" aria-label="Page ".{{ $page }} aria-current="page">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}" class="pagination-link" aria-label="Goto page ".{{ $page }}>{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
        @if ($paginator->hasMorePages())
            <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="prev">Next</a>
        @else
            <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="prev" disabled>Next</a>
        @endif
    </nav>
@endif
