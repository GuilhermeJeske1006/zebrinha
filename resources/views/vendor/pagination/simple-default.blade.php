@if ($paginator->hasPages())
{{--    <nav>--}}
{{--        <ul class="pagination">--}}
{{--            --}}{{-- Previous Page Link --}}
{{--            @if ($paginator->onFirstPage())--}}
{{--                <li class="disabled" aria-disabled="true"><span>@lang('pagination.previous')</span></li>--}}
{{--            @else--}}
{{--                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>--}}
{{--            @endif--}}

{{--            --}}{{-- Next Page Link --}}
{{--            @if ($paginator->hasMorePages())--}}
{{--                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>--}}
{{--            @else--}}
{{--                <li class="disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>--}}
{{--            @endif--}}
{{--        </ul>--}}
{{--    </nav>--}}
    <div class="flex-c-m flex-w w-full p-t-45">
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Ver mais
            </a>
        @else
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class=" disabled flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Ver mais
            </a>
        @endif

    </div>
@endif
