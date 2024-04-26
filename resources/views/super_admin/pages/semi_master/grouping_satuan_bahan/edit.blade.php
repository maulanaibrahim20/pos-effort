<form action="{{ url('super_admin/semi_master/grouping_satuan_bahan/' . $edit->id) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label class="form-label">Pilih Satuan Bahan</label>
            <select name="satuanBahan_modal" class="form-control select2 form-select" id="satuanBahan">
                <option value="">-- Pilih --</option>
                @foreach ($satuanBahan as $select)
                    <option value="{{ $select->id }}" {{ $edit->satuanBahanId == $select->id ? 'selected' : '' }}>
                        {{ $select->satuanBahan }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Pilih Bahan</label>
            <select name="bahan_modal" class="form-control select2 form-select" id="bahan">
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
