<div class="modal fade" id="editPostCatModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa danh mục bài viết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" id="editForm">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="col-form-label">Tên danh mục:</label>
                        <input type="text" class="form-control" id="edit_name" name="name">
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_parent_id" class="col-form-label">Danh mục cha:</label>
                        <select class="form-control" id="edit_parent_id" name="parent_id">
                            <option value="">-----Chọn danh mục cha-----</option>
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label d-block">Trạng thái:</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="edit_status_pending"
                                value="{{ App\Models\PostCat::STATUS_PENDING }}">
                            <label class="form-check-label" for="edit_status_pending">
                                Chờ duyệt
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="edit_status_public"
                                value="{{ App\Models\PostCat::STATUS_PUBLIC }}">
                            <label class="form-check-label" for="edit_status_public">
                                Công khai
                            </label>
                        </div>

                        @error('status')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>