<form action="{{ url('super_admin/semi_master/grouping_kategori_bahan/' . $edit->id) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label class="form-label">Pilih Kategori Bahan</label>
            <select name="kategori_modal" class="form-control select2 form-select" id="kategori">
                <option value="">-- Pilih --</option>
                @foreach ($kategoriBahan as $select)
                    <option value="{{ $select->id }}" {{ $edit->kategoriBahanId == $select->id ? 'selected' : '' }}>
                        {{ $select->namaKategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Pilih Bahan</label>
            <select name="bahan_modal" class="form-control select2 form-select" id="kategori">
                <option value="">-- Pilih --</option>
                @foreach ($bahan as $selected)
                    <option value="{{ $selected->id }}" {{ $edit->bahanId == $selected->id ? 'selected' : '' }}>
                        {{ $selected->namaBahan }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="modal-footer">
        @include('template.component.button.button_modal')
    </div>
</form>
