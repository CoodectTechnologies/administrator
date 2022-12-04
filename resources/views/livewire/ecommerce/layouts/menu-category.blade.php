<div>
    <div>
        <div class="dropdown-box">
            <ul class="menu vertical-menu category-menu">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('ecommerce.product.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        @if (count($category->allChildrens))
                            @include('ecommerce.layouts.menu.partials._category', ['category' => $category])
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
