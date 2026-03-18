@extends('layouts.admin')

@section('content')
    <script src="https://cdn.tiny.cloud/1/00l9mte9oevy90w9i5vhjv1vhbtlwbe0y07rbncfhtqa2gy4/tinymce/5/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>

    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật sản phẩm
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('admin/product/update/' . $product->id) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ $product->name }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price">Giá</label>
                                <input class="form-control" type="text" name="price" id="price"
                                    value="{{ $product->price }}">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="description">Mô tả sản phẩm</label>
                                <textarea class="form-control" id="description" name="description" cols="30" rows="5">{{ $product->description }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail">Ảnh đại diện</label>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control">

                        @if (!empty($product->thumbnail))
                            <div class="mt-2">
                                <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" width="120">
                            </div>
                        @endif

                        @error('thumbnail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="detail">Chi tiết sản phẩm</label>
                        <textarea name="detail" class="form-control" id="detail" cols="30" rows="15">{{ $product->detail }}</textarea>
                        @error('detail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cat">Danh mục</label>
                        <select class="form-control" id="cat" name="cat">
                            <option value="">------Chọn danh mục------</option>
                            @foreach ($product_cats as $cat)
                                <option value="{{ $cat->id }}" {{ $product->cat_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('cat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Trạng thái</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="in_stock" name="status"
                                value="{{ App\Models\Product::STATUS_IN_STOCK }}"
                                {{ $product->status == App\Models\Product::STATUS_IN_STOCK ? 'checked' : '' }}>
                            <label class="form-check-label" for="in_stock">Còn hàng</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="out_of_stock" name="status"
                                value="{{ App\Models\Product::STATUS_OUT_OF_STOCK }}"
                                {{ $product->status == App\Models\Product::STATUS_OUT_OF_STOCK ? 'checked' : '' }}>
                            <label class="form-check-label" for="out_of_stock">Hết hàng</label>
                        </div>

                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document
                    .getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

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