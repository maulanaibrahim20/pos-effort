<form action="{{ url('super_admin/master/satuan_bahan/' . $edit->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="recipient-name" class="form-control-label">Nama Kategori Bahan</label>
        <input type="text" name="nama_modal" class="form-control" value="{{ $edit->satuanBahan }}">
    </div>
</form>
