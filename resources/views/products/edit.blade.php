@extends('layouts.app')
@section('content')
    <main class="container">
        <section>
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="titlebar">
                    <h1>Edit Produk</h1>
                </div>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors - all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div>
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ $product->name }}">
                        <label>Deskripsi (opsional)</label>
                        <textarea cols="10" rows="5" name="description" value="{{ $product->description }}">{{ $product->description }}</textarea>
                        <label>Tambah Gambar</label>
                        <img src="{{ asset('images/' . $product->image) }}" alt="" class="img-product"
                            id="file-preview" />
                        <input type="hidden" name="hidden_product_image" value={{ $product->image }}>
                        <input type="file" name="image" accept="image/*" onchange="showFile(event)">
                    </div>
                    <div>
                        <label>Kategori</label>
                        <select name="category">
                            @foreach (json_decode('{"Sushi":"Sushi", "Ramen":"Ramen", "Rice Bowl":"Rice Bowl", "Dessert":"Dessert", "Minuman":"Minuman"}', true) as $optionKey => $optionValue)
                                <option value="{{ $optionKey }}"
                                    {{ isset($product->category) && $product->category == $optionKey ? 'selected' : '' }}>
                                    {{ $optionValue }}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label>Stok</label>
                        <input type="text" name="quantity" value="{{ $product->quantity }}">
                        <hr>
                        <label>Harga</label>
                        <input type="text" name="price" value="{{ $product->price }}">
                    </div>
                </div>
                <div class="titlebar">
                    <h1></h1>
                    <input type="hidden" name="hidden_id" value="{{ $product->id }}">
                    <button class="btn-success">Simpan</button>
                </div>
            </form>
        </section>
    </main>
    <script>
        function showFile(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('file-preview');
                output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
