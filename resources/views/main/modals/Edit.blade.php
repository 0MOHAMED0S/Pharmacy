<!-- Edit Modal -->
<div class="modal fade" id="editModal-{{ $medicine->id }}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('medicines.update', $medicine->id) }}"
                    enctype="multipart/form-data" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <!-- Name Field -->
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 text-end control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="Name" placeholder="Name Here" name="name"
                                    value="{{ old('name', $medicine->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Price Field (Decimal Support) -->
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 text-end control-label col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" placeholder="Price here" name="price"
                                    value="{{ old('price', $medicine->price) }}" step="0.01" min="0" />
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Quantity Field -->
                        <div class="form-group row">
                            <label for="quantity"
                                class="col-sm-3 text-end control-label col-form-label">Quantity</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                    id="quantity" placeholder="Quantity Here" name="quantity"
                                    value="{{ old('quantity', $medicine->quantity) }}" />
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 text-end control-label col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control @error('path') is-invalid @enderror"
                                    id="image" name="path" accept="image/*" onchange="previewImage(event)" />
                                @error('path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Show existing image -->
                                <div class="mt-3">
                                    <img id="imagePreview"
                                        src="{{ $medicine->path ? asset('storage/' . $medicine->path) : '' }}"
                                        alt="Current Image" class="img-thumbnail {{ $medicine->path ? '' : 'd-none' }}"
                                        width="120">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="border-top">
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for Image Preview -->
<script>
    function previewImage(event) {
        var image = document.getElementById('imagePreview');
        var file = event.target.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                image.src = reader.result;
                image.classList.remove("d-none"); // Show preview
            };
            reader.readAsDataURL(file);
        }
    }
</script>
