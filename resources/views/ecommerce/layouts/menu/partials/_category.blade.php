<ul>
    @foreach ($category->allChildrens as $categoryChildren)
        <li>
            <a href="#">{{ $categoryChildren->name }}</a>
            @if (count($categoryChildren->allChildrens))
                @include('ecommerce.layouts.menu.partials._category', ['category' => $categoryChildren])
            @endif
        </li>
    @endforeach
</ul>


