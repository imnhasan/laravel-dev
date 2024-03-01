<h1>Shopping Cart</h1>
<div>
    @if(Session::has('cart'))
        <ul>
            @foreach($products as $product)
                <li>{{ $product['item']['name'] }} <span style="color: #0b5ed7"> {{ $product['qyt'] }}</span> 💰 <span>{{ $product['price'] }}</span></li>
            @endforeach
        </ul>
        <h4>Total Price: {{ $totalPrice }}</h4>
        <hr>
        <a href="{{ route('product.checkout') }}">checkout</a>
    @else
        <h4>{{ 'Nothing in car' }}</h4>
    @endif

</div>
