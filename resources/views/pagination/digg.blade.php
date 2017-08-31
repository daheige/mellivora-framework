@if ($paginator->hasPages())
<ul class="pagination">

    @if ($paginator->onFirstPage())
        <li class="disabled">
            <span><i class="fa fa-angle-left"></i> {{ __('Previous') }}</span>
        </li>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" title="{{ __('Previous') }}">
            <i class="fa fa-angle-left"></i>
            {{ __('Previous') }}
        </a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" title="{{ __('Next') }}">
            <i class="fa fa-angle-right"></i>
            {{ __('Next') }}
        </a>
    @else
        <li class="disabled">
            <span><i class="fa fa-angle-right"></i> {{ __('Next') }}</span>
        </li>
    @endif

</ul>
@endif
