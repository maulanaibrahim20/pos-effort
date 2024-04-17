<form action="{{ url('super_admin/master/bahan/' . $edit->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="form-control-label">Nama Kategori Bahan</label>
            <input type="text" name="nama" class="form-control" value="{{ $edit->namaBahan }}">
        </div>
        <div class="form-group">
            <label for="place-bottom-right" class="form-label">Foto</label>
            <input type="file" name="foto" class="dropify" data-height="200">
            <td><img src="{{ asset('' . $edit->fotoBahan) }}" style="width:100px;height:100">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary br-7" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary br-7">Send message</button>
    </div>
</form>
