@extends('layouts.app')
@section('content')
    <main class="container">
        <section>
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="titlebar">
                    <h1>Tambah Produk</h1>
                </div>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
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
                        <input type="text" name="name">
                        <label>Deskripsi (opsional)</label>
                        <textarea cols="10" rows="5" name="description"></textarea>
                        <label>Tambah Gambar</label>
                        <img src="" alt="" class="img-product" id="file-preview" />
                        <input type="file" name="image" accept="image/*" onchange="showFile(event)">
                    </div>
                    <div>
                        <label>Kategori</label>
                        <select name="category">
                            @foreach (json_decode('{"Sushi":"Sushi", "Ramen":"Ramen", "Rice Bowl":"Rice Bowl", "Dessert":"Dessert", "Minuman":"Minuman"}', true) as $optionKey => $optionValue)
                                <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label>Stok</label>
                        <input type="text" name="quantity">
                        <hr>
                        <label>Harga</label>
                        <input type="text" name="price">
                    </div>
                </div>
                <div class="titlebar">
                    <h1></h1>
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
