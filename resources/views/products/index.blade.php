
<a href="{{ route('product.shopping_cart') }}">{{ 'shopping cart' }} {{ Session::has('cart') ? Session::get('cart')->totalQyt : ''  }}</a>

<ul>
@foreach($products as $product)
    <li>{{ $product->name }}  <span>{{ $product->price }}</span> <a href="{{ route('product.add_to_cart', ['id' => $product->id]) }}"><button>add to cart</button></a></li>
    <br>
@endforeach
</ul>
