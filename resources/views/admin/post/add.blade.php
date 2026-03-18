@extends('layouts.admin')

@section('content')
    <script src="https://cdn.tiny.cloud/1/00l9mte9oevy90w9i5vhjv1vhbtlwbe0y07rbncfhtqa2gy4/tinymce/5/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm bài viết
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('admin/post/insert') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title">Tiêu đề bài viết</label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                            id="title">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="detail">Nội dung bài viết</label>
                        <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" id="detail"
                            cols="30" rows="15"></textarea>
                        @error('detail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Ảnh đại diện</label>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Danh mục</label>
                        <select class="form-control" id="cat_id" name="cat_id">
                            <option value="">------Chọn danh mục------</option>
                            @foreach ($post_cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status1"
                                value="{{App\Models\Post::STATUS_PENDING}}" checked>
                            <label class="form-check-label" for="status1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status2"
                                value="{{App\Models\Post::STATUS_PUBLIC}}">
                            <label class="form-check-label" for="status2">
                                Công khai
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        var editor_config = {
            path_absolute: "http://127.0.0.1:8000/",
            selector: 'textarea#detail',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function (callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endsection