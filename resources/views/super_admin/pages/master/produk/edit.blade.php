<form action="{{ url('super_admin/master/produk/' . $edit->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="form-control-label">Nama Kategori Bahan</label>
            <select name="kategori_modal" class="form-control select2 form-select" id="kategori">
                <option value="">-- Pilih --</option>
                <option value="makanan" {{ $edit->kategori == 'Makanan' ? 'selected' : '' }}>Makanan
                </option>
                <option value="minuman" {{ $edit->kategori == 'Minuman' ? 'selected' : '' }}>Minuman
                </option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Harga</label>
            <input id="editHargaInput" class="form-control" value="{{ $edit->hargaProduk }}" name="harga_modal"
                type="text">
        </div>
        <div class="form-group">
            <label for="place-bottom-right" class="form-label">Foto</label>
            <input type="file" name="foto_modal" class="dropify" data-height="200">
            <td><img src="{{ asset('' . $edit->fotoProduk) }}" style="width:100px;height:100">
        </div>
    </div>
    <div class="modal-footer">
        @include('template.component.button.button_modal')
    </div>
</form>

<script src="{{ url('/assets') }}/plugins/fileuploads/js/fileupload.js"></script>
<script src="{{ url('/assets') }}/plugins/fileuploads/js/file-upload.js"></script>
