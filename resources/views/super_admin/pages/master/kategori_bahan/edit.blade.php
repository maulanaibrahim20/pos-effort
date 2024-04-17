<form action="{{ url('super_admin/master/kategori_bahan/' . $edit->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="form-control-label">Nama Kategori Bahan</label>
            <input type="text" name="nama" class="form-control" value="{{ $edit->namaKategori }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary br-7" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary br-7">
            Submit
        </button>
    </div>
</form>
