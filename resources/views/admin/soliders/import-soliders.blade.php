
<div class="modal fade" id="import-soliders">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> استيراد بيانات الجنود من ملف اكسيل</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin.soliders.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file"> الملف</label>
                        <input type="file" class="form-control" name="file" id="file">
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default active" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-success active">استيراد</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
