@section('modal-css')
@endsection
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
        @include('template.component.button.button_modal')
    </div>
</form>
@section('modal-script')
@endsection
