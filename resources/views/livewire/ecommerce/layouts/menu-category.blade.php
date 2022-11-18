<div>
    <div>
        <div class="dropdown-box">
            <ul class="menu vertical-menu category-menu">
                @foreach ($categories as $category)
                    <li>
                        <a href="#">{{ $category->name }}</a>
                        @if (count($category->allChildrens))
                            @include('ecommerce.layouts.menu.partials._category', ['category' => $category])
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
