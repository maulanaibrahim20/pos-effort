<form action="{{ url('/pembayaran-cash/' . $transaksi['id']) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="amount" class="mb-2"> Harga Transaksi </label>
            <input type="text" class="form-control" name="amount" id="amount" value="{{ $transaksi["totalHarga"] }}" disabled>
        </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-danger btn-xs" style="margin-right: 10px">
            <i class="fa fa-times"></i> Batal
        </button>
        <button class="btn btn-primary btn-xs">
            <i class="fa fa-edit"></i> Simpan
        </button>
    </div>
</form>
