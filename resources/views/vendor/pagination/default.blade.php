@if ($paginator->hasPages())
<div style="text-align: center;">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled grey-text" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true"><i class="material-icons">chevron_left</i></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="waves-effect" style="padding: 0px;">
                        <i class="material-icons">chevron_left</i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active teal lighten-1" aria-current="page"><a>{{ $page }}</a></li>
                        @else
                            <li><a class="waves-effect" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="waves-effect">
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            @else
                <li class="disabled grey-text" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true"><i class="material-icons">chevron_right</i></span>
                </li>
            @endif
        </ul>
    </div>
@endif
