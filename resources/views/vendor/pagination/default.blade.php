@if ($paginator->hasPages())
    <div class="pt-0 border-0 ul-pagination">
        <ul>
            @if ($paginator->onFirstPage())
                <li class="active">
                    <i class="flaticon-left-arrow"></i>
                </li>
            @else
                <li class="active">
                    <a href="{{ $paginator->previousPageUrl() }}"><i class="flaticon-left-arrow"></i></a>
                </li>
            @endif
            <li class="pages">
                @foreach ($elements as $element)
                    {{-- Arraay Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a class="active">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </li>
            @if ($paginator->hasMorePages())
                <li class="active">
                    <a href="{{ $paginator->nextPageUrl() }}"><i class="flaticon-right-arrow-3"></i></a>
                </li>
            @else
                <li>
                    <i class="flaticon-right-arrow-3"></i>
                </li>
            @endif
        </ul>
    </div>
@endif
