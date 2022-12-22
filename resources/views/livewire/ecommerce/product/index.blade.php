<div>
    <div class="page-content mb-10">
        <div class="container">
            <!-- Start of Shop Content -->
            <div class="shop-content row gutter-lg">
                <!-- Start of Sidebar, Shop Sidebar -->
                <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                    <!-- Start of Sidebar Overlay -->
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                    <!-- Start of Sidebar Content -->
                    <div class="sidebar-content scrollable">
                        <!-- Start of Sticky Sidebar -->
                        <div class="sticky-sidebar">
                            <div class="filter-actions">
                                <label>{{ __('Filters') }} :</label>
                                @if ($this->existAnyFilter())
                                    <a wire:click.prevent="clearFilter" href="#" class="btn btn-dark btn-link filter-clean">{{ __('All clear') }}</a>
                                @endif
                            </div>
                            <!-- Start of Collapsible widget -->
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title"><span>{{ __('All categories') }}</span></h3>
                                <ul class="widget-body filter-items search-ul">
                                    @foreach ($productCategories as $productCategory)
                                        <li>
                                            <a href="{{ route('ecommerce.product.index', ['category' => $productCategory->slug]) }}">
                                                {{ $productCategory->name }}
                                                <span class="text-end">{{ count($productCategory->products) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End of Collapsible Widget -->

                            <!-- Start of Collapsible Widget -->
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <span>{{ __('Price') }}</span>
                                    <span wire:loading.class="spinner-grow spinner-grow-sm" wire:target="filterPrice"></span>
                                </h3>
                                <div class="widget-body">
                                    <ul class="filter-items search-ul">
                                        <li wire:click.prevent="filterPrice(0, 100)"><a href="#">$0.00 - $100.00</a></li>
                                        <li wire:click.prevent="filterPrice(100, 200)"><a href="#">$100.00 - $200.00</a></li>
                                        <li wire:click.prevent="filterPrice(200, 300)"><a href="#">$200.00 - $300.00</a></li>
                                        <li wire:click.prevent="filterPrice(300, 500)"><a href="#">$300.00 - $500.00</a></li>
                                        <li wire:click.prevent="filterPrice(500, '')"><a href="#">$500.00+</a></li>
                                    </ul>
                                    <form class="price-range" action="{{ route('ecommerce.product.index') }}">
                                        <input wire:model.defer="minPriceFilter" type="number" name="minPrice" class="min_price text-center" placeholder="$min">
                                        <span class="delimiter">-</span>
                                        <input wire:model.defer="maxPriceFilter" type="number" name="maxPrice" class="max_price text-center" placeholder="$max">
                                        <button type="submit" class="btn btn-primary btn-rounded">{{ __('Apply') }}</button>
                                    </form>
                                </div>
                            </div>
                            <!-- End of Collapsible Widget -->

                            <!-- Start of Collapsible widget -->
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title"><span>{{ __('Brand') }}</span></h3>
                                <ul class="widget-body filter-items search-ul">
                                    @foreach ($productBrands as $productBrand)
                                        <li>
                                            <a href="{{ route('ecommerce.product.index', ['brand' => $productBrand->slug]) }}">
                                                {{ $productBrand->name }}
                                                <span class="text-end">{{ count($productBrand->products) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End of Collapsible Widget -->

                        </div>
                        <!-- End of Sidebar Content -->
                    </div>
                    <!-- End of Sidebar Content -->
                </aside>
                <!-- End of Shop Sidebar -->

                <!-- Start of Main Content -->
                <div class="main-content">
                    <!-- Start of Shop Banner -->
                    <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center mb-6 br-xs"
                        style="background-image: url(https://portotheme.com/html/wolmart/assets/images/shop/banner1.jpg); background-color: #FFC74E;">
                        <div class="banner-content">
                            <h4 class="banner-subtitle font-weight-bold">Accessories Collection</h4>
                            <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-10">Smart
                                Watches
                            </h3>
                            <a href="shop-banner-sidebar.html"
                                class="btn btn-dark btn-rounded btn-icon-right">
                                Discover Now
                                <i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- End of Shop Banner -->

                    <nav class="toolbox sticky-toolbox sticky-content fix-top">
                        <div class="toolbox-left">
                            <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle btn-icon-left d-block d-lg-none"><i class="w-icon-category"></i><span>{{ __('Filters') }}</span></a>
                            <div class="toolbox-item toolbox-sort select-box text-dark">
                                <label>{{ __('Sort By') }} :</label>
                                <select wire:model="orderByFilter" name="orderByFilter" class="form-control">
                                    <option value="">{{ __('Default sorting') }}</option>
                                    <option value="price-low">{{ __('Sort by price: low to high') }}</option>
                                    <option value="price-high">{{ __('Sort by price: high to low') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show select-box">
                                <select wire:model="perPage" name="perPage" class="form-control">
                                    <option value="9">{{ __('Show') }} 9</option>
                                    <option value="12">{{ __('Show') }} 12</option>
                                    <option value="24">{{ __('Show') }} 24</option>
                                    <option value="36">{{ __('Show') }} 36</option>
                                </select>
                            </div>
                        </div>
                    </nav>
                    <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2">
                        @foreach ($products as $product)
                            @include('ecommerce.product.partials._product')
                        @endforeach
                    </div>
                    <div class="toolbox toolbox-pagination justify-content-between">
                        <p class="showing-info mb-2 mb-sm-0">
                            {{ __('Showing') }}<span>{{($products->currentpage()-1)*$products->perpage()+1}} - {{$products->currentpage()*$products->perpage()}}
                                de  {{$products->total()}}</span>{{ __('Products') }}
                        </p>
                       {{ $products->links() }}
                    </div>
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Shop Content -->
        </div>
    </div>
</div>
