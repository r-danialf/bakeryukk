
  <div class="container mt-4">
    <div class="row">
      <!-- Assume your server-side templating engine renders this foreach loop -->
      <!-- Replace with your actual data rendering code -->
      @foreach ($products as $product)
      <div id="{{ $product->id }}" class="col-md-6 mb-3" onclick="checkProduct({{ $product->id }})">
        <div class="border p-3 product-box">
          <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('storage/images/products/'.$product->image) }}" alt="{{ $product->productName }}" class="product-img">
            <span><b>{{ $product->productName }}</b></span>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <span><i>Rp{{ $product->price }}</i></span>
            <span><b>{{ $product->stock }}x</b></span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <style>
    /* Optional custom styles for the product box */
    .product-box {
      cursor: pointer;
      transition: box-shadow 0.3s ease;
    }
    .product-box:hover {
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .product-img {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }
  </style>

  <script>
    function checkProduct(id) {
      window.location.href = `/product/${id}`;
    }
</script>