<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product Row List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .productlist {
      display: flex;
      flex-wrap: wrap;
      overflow-x: auto;
      gap: 1rem;
      padding: 1rem 0;
    }
    .product {
      flex: 0 0 auto;
      width: 200px; /* adjust as needed */
      border: 1px solid #ddd;
      padding: 0.5rem;
      border-radius: 4px;
      text-align: center;
      transition: box-shadow 0.3s;
      cursor: pointer;
    }
    .product:hover {
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .productname {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      margin-bottom: 0.5rem;
    }
    .productname img {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }
    .productinfo {
      display: flex;
      justify-content: space-between;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="container mt-4">
    <div class="productlist">
      @foreach ($products as $product)
      <div id="{{ $product->id }}" class="product">
        <div class="productname">
          <img src="{{ asset('storage/images/products/'.$product->image) }}" alt="{{ $product->productName }}">
          <span><b>{{ $product->productName }}</b></span>
        </div>
        <div class="productinfo">
          <span><i>Rp{{ $product->price }}</i></span>
          <span><b>{{ $product->stock }}x</b></span>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
