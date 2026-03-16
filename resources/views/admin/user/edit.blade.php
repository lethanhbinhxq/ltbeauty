<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa thông tin người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" id="editForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" id="name" name="name">
                        @error('name')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="col-form-label">Quyền:</label>
                        <select class="form-control" id="role">
                            <option>-----Chọn quyền-----</option>
                            <option>Danh mục 1</option>
                            <option>Danh mục 2</option>
                            <option>Danh mục 3</option>
                            <option>Danh mục 4</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="col-form-label">Trạng thái:</label>
                        <select class="form-control" id="status" name="status">
                            <option>-----Chọn trạng thái-----</option>
                            <option value="{{ App\Models\User::STATUS_ACTIVE }}">Đang hoạt động</option>
                            <option value="{{ App\Models\User::STATUS_PENDING }}">Chờ duyệt</option>
                            <option value="{{ App\Models\User::STATUS_BLOCKED }}">Bị khóa</option>
                        </select>
                        @error('status')
                            <small class="form-text text-danger">{{$message}}</small>
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