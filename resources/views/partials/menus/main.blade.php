{{-- Left menu generated by Voyager --}}
<ul class="nav-left">
    @foreach($items as $menu_item)
        @if ($menu_item->title == 'Categories')
            <li class="nav-item-dropdown" data-dropdown-menu="categories-dropdown-menu">
                <a class="custom-dropdown-toggle" data-dropdown-menu="categories-dropdown-menu" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a>

                <div class="custom-dropdown-menu">
                    <ul class="custom-dropdown-menu-ul" id="categories-dropdown-menu">
                        @foreach (getCategories() as $category)
                            <li>
                                <a href="{{ route('shop.index', ['category' => lcfirst($category->name)]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @else
            <li>
            	<a id="nav-{{ lcfirst($menu_item->title) }}" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a>
            </li>
        @endif
    @endforeach
</ul>

{{-- Authentication Links --}}
<ul class="nav-right">
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item-dropdown" data-dropdown-menu="user-dropdown-menu">
            <a class="nav-link custom-dropdown-toggle" data-dropdown-menu="user-dropdown-menu" href="{{ route('profile.edit') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="custom-dropdown-menu">
                <ul class="custom-dropdown-menu-ul" id="user-dropdown-menu">
                    <li>
                        <a href="{{ route('profile.edit') }}">My Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}">My Orders</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </li>
    @endguest

    <li>
        <a href="{{ route('wishlist.index') }}" title="Wishlist">
            <i class="far fa-heart"></i>
            @if (Cart::instance('wishlist')->count())
                <span class="wishlist-count"><span>{{ Cart::instance('wishlist')->count() }}</span></span>
            @endif
        </a> 
    </li>

    <li>
        <a href="{{ route('cart.index') }}" title="Cart">
            <i class="fa fa-cart-plus"></i> 
            @if (Cart::instance('default')->count())
                <span class="cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
            @endif
        </a> 
    </li>
</ul>

<script>

    let navItemDropdownList = document.querySelectorAll('.nav-item-dropdown');
    let dropdownToggleList = document.querySelectorAll('.custom-dropdown-toggle');
    let dropdownMenuUlList = document.querySelectorAll('.custom-dropdown-menu-ul');
    
    // Show dropdown menu when hovering over the user name
    if (dropdownToggleList.length) {
        dropdownToggleList.forEach(el => {
            el.addEventListener('mouseover', e => {
                document.getElementById(e.target.dataset.dropdownMenu).classList.add('show');
            });
        });
    }

    if (navItemDropdownList.length) {
        navItemDropdownList.forEach(el => {
            el.addEventListener('mouseleave', (e) => {
                document.getElementById(e.target.dataset.dropdownMenu).classList.remove('show');
            });
        });
    }

    if (dropdownMenuUlList) {
        dropdownMenuUlList.forEach((el) => {
            el.addEventListener('mouseover', (e) => {
                e.target.classList.add('show');
            });

            el.addEventListener('mouseleave', (e) => {
                e.target.classList.remove('show');
            });
        });
    }

</script>
