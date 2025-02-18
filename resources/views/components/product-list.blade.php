<div class="productlist">
    @foreach ($products as $product)
        <div id="{{ $product->id }}" class="product" onclick="checkProduct({{ $product->id }})">
            <div class="productname">
                <img src="{{ asset('storage/images/products/'.$product->image) }}">
                <span><b>{{ $product->productName }}</b></span>
            </div>
            <div class="productinfo">
                <span><i>Rp{{ $product->price }}</i></span>
                <span><b>{{ $product->stock }}x</b></span>
            </div>
        </div>
    @endforeach
</div>

<script>
    function checkProduct(id) {
        window.location.href = `/product/${id}`;
    }
</script>
