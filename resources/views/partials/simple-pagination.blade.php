<hr>
<nav id="pagination ">
    @if ($paginator->hasPages())
        <ul class="uk-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="uk-disabled" aria-disabled="true"><a href=""><span class="uk-margin-small-right" uk-pagination-previous></span> Trang trước </a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span class="uk-margin-small-right" uk-pagination-previous></span> Trang trước </a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="uk-margin-auto-left"><a href="{{ $paginator->nextPageUrl() }}" rel="next">Trang kế <span  class="uk-margin-small-left" uk-pagination-next></span></a></li>
            @else
                <li class="uk-disabled uk-margin-auto-left" aria-disabled="true"><a href="">Trang kế <span  class="uk-margin-small-left" uk-pagination-next></span></a></li>
            @endif
        </ul>
    @endif
</nav>
