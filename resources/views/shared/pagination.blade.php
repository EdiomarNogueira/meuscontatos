@if ($paginator->hasPages())
<ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="disabled"><ion-icon name="arrow-round-back"></ion-icon>Anterior</li>
    @else
    <li class="waves-effect"><a href="{{ $paginator->previousPageUrl() }}"><ion-icon name="arrow-round-back"></ion-icon>Anterior</li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li class="disabled">{{ $element }}</li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="active">
        <a>{{ $page }}</a>
    </li>
    @else
    <li class="waves-effect"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li class="waves-effect"><a href="{{ $paginator->nextPageUrl() }}">Próximo<ion-icon name="arrow-round-forward"></ion-icon></a></li>
    @else
    <li class="disabled"><a href="{{ $paginator->nextPageUrl() }}">Próximo<ion-icon name="arrow-round-forward"></ion-icon></a></li>
    @endif
</ul>
@endif
