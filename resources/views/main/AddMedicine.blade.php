@extends('layouts.master')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Medicinies</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{route('medicines.index')}}">All</a>
                            </li>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" action="{{ route('medicines.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card-body">
                            <!-- Name Field -->
                            <div class="form-group row">
                                <label for="Name" class="col-sm-3 text-end control-label col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="Name" placeholder="Name Here" name="name" value="{{ old('name') }}" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Price Field -->
                            <div class="form-group row">
                                <label for="price" class="col-sm-3 text-end control-label col-form-label">Price</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" placeholder="Price here" name="price" value="{{ old('price') }}"
                                        step="0.01" min="0" />
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Quantity Field -->
                            <div class="form-group row">
                                <label for="quantity" class="col-sm-3 text-end control-label col-form-label">Quantity</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                        id="quantity" placeholder="Quantity Here" name="quantity"
                                        value="{{ old('quantity') }}" />
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image Upload Field with Preview -->
                            <div class="form-group row">
                                <label for="image" class="col-sm-3 text-end control-label col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control @error('path') is-invalid @enderror"
                                        id="image" name="path" accept="image/*" onchange="previewImage(event)" />
                                    @error('path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!-- Image Preview -->
                                    <div class="mt-3">
                                        <img id="imagePreview" src="" alt="Image Preview" class="img-thumbnail d-none" width="120">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="border-top">
                            <div class="card-body text-center">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>

                    <!-- JavaScript for Image Preview -->
                    <script>
                        function previewImage(event) {
                            var image = document.getElementById('imagePreview');
                            var file = event.target.files[0];

                            if (file) {
                                var reader = new FileReader();
                                reader.onload = function() {
                                    image.src = reader.result;
                                    image.classList.remove("d-none");
                                };
                                reader.readAsDataURL(file);
                            }
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection
