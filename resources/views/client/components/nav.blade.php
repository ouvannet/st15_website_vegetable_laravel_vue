<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="/client/home">Vegefoods</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a href="/client/home" class="nav-link">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/client/shop" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="/client/shop">Shop</a>
                <a class="dropdown-item" href="/client/wishlist">Wishlist</a>
              {{-- <a class="dropdown-item" href="/client/shop/single_product">Single Product</a> --}}
              <a class="dropdown-item" href="/client/cart">Cart</a>
              <a class="dropdown-item" href="/client/checkout">Checkout</a>
            </div>
          </li>
          <li class="nav-item"><a href="/client/about" class="nav-link">About</a></li>
          <li class="nav-item"><a href="/client/blog" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="/client/contact" class="nav-link">Contact</a></li>
          <li class="nav-item cta cta-colored"><a href="/client/cart" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>

        </ul>
      </div>
    </div>
</nav>
