@if ($paginator->hasPages())
    <nav>
        <ul class="pagination mt-2">

            @if ($paginator->onFirstPage())
                <li class="page-item prev-item disabled">
                    <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                        <span aria-hidden="true"></span>
                    </a>
                </li>
            @else
                <li class="page-item prev-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true"></span>
                    </a>
                </li>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item page-link disabled">
                        {{ $element }}
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="javascript:void(0)">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item " aria-current="page">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item next-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true"></span>
                    </a>
                </li>
            @else
                <li class="page-item next-item disabled">
                    <a class="page-link" href="javascript:void(0)" aria-label="Next">
                        <span aria-hidden="true"></span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
