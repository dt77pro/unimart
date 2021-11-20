<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <script src="https://cdn.tiny.cloud/1/a279vio7z4hpbamq8r3lr166rwi49fmpy30d4jeperlygqkk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var editor_config = {
          path_absolute : "http://localhost/laravel_unimart/unimart/",
          selector: 'textarea.text-content',
          height: 400,
          relative_urls: false,
          plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table directionality",
            "emoticons template paste textpattern"
          ],
          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
          file_picker_callback : function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
      
            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
            if (meta.filetype == 'image') {
              cmsURL = cmsURL + "&type=Images";
            } else {
              cmsURL = cmsURL + "&type=Files";
            }
      
            tinyMCE.activeEditor.windowManager.openUrl({
              url : cmsURL,
              title : 'Filemanager',
              width : x * 0.8,
              height : y * 0.8,
              resizable : "yes",
              close_previous : "no",
              onMessage: (api, message) => {
                callback(message.content);
              }
            });
          }
        };
      
        tinymce.init(editor_config);
    </script>
    <title>Admintrator</title>

</head>

<body>
    <div id="warpper" class="nav-fixed">
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand"><a href="{{url('dashboard')}}">UNIMART</a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('admin/user/add')}}">Thêm thành viên</a>
                        <a class="dropdown-item" href="{{url('admin/post/add')}}">Thêm bài viết</a>
                        <a class="dropdown-item" href="{{url('admin/product/add')}}">Thêm sản phẩm</a>
                        <a class="dropdown-item" href="{{url('admin/transaction/list')}}">Xem đơn hàng</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (Auth::check())
                            {{ Auth::user()->name }}
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Tài khoản</a>
                        <form method="POST" action="{{ route('post.logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{route('post.logout')}}"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Đăng xuất') }}
                            </a>
                        </form>
                        
                    </div>
                </div>
            </div>
        </nav>
        <!-- end nav  -->
        @php
        $module_active = session('module_active');
        // dd($module_active);
        @endphp
        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu">
                    @can('index-dashboard')
                        <li class="nav-link {{$module_active == 'dashboard'?'active':''}}">
                            <a href="{{url('dashboard')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="fab fa-centos"></i>
                                </div>
                                Dashboard
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                        </li>
                    @endcan

                    @can('list-page')
                        <li class="nav-link {{$module_active == 'page'?'active':''}}">
                            <a href="{{url('admin/page/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="fa fa-map icon"></i>
                                </div>
                                Quản Lý Trang
                            </a>
                            <i class="arrow fas fa-angle-right"></i>

                            <ul class="sub-menu">
                                @can('add-page')
                                <li><a href="{{url('admin/page/add')}}">Thêm mới</a></li>
                                @endcan
                                <li><a href="{{url('admin/page/list')}}">Danh sách</a></li>
                            </ul>
                        </li> 
                    @endcan

                    @can('list-post')
                    <li class="nav-link {{$module_active == 'post'?'active':''}}">
                        <a href="{{url('admin/post/list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-edit"></i>
                            </div>
                            Quản Lý Bài Viết
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{url('admin/post/add')}}">Thêm mới</a></li>
                            <li><a href="{{url('admin/post/list')}}">Danh sách</a></li>
                            <li><a href="{{url('admin/post/cat/list')}}">Danh mục</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('list-product')
                        <li class="nav-link {{$module_active == 'product'?'active':''}}">
                            <a href="{{url('admin/product/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="fab fa-product-hunt"></i>
                                </div>
                                Quản Lý Sản Phẩm
                            </a>
                            <i class="arrow fas fa-angle-down"></i>
                            <ul class="sub-menu">
                                @can('add-product')
                                    <li><a href="{{url('admin/product/add')}}">Thêm mới</a></li>
                                @endcan
                                <li><a href="{{url('admin/product/list')}}">Danh sách</a></li>
                                <li><a href="{{url('admin/product/cat/list')}}">Danh mục</a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('list-order')
                        <li class="nav-link {{$module_active == 'transaction'?'active':''}}">
                            <a href="{{url('admin/transaction/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="fa fa-database icon"></i>
                                </div>
                                Quản Lý Bán Hàng
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                <li><a href="{{url('admin/transaction/list')}}">Đơn hàng</a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('list-about')
                        <li class="nav-link {{$module_active == 'about'?'active':''}}">
                            <a href="{{url('admin/contact/edit/{id}')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Quản Lý Abouts
                            </a>
                            <i class="arrow fas fa-angle-right"></i>

                            <ul class="sub-menu">
                                <li><a href="{{url('admin/contact/add')}}">Tạo liên hệ mới</a></li>
                                <li><a href="{{url('admin/contact/edit/{id}')}}">Cập nhật liên hệ</a></li>
                                <li><a href="{{url('admin/recommend/add')}}">Tạo giới thiệu mới</a></li>
                                <li><a href="{{url('admin/recommend/edit/{id}')}}">Cập nhật giới thiệu</a></li>
                            </ul>
                        </li> 
                    @endcan
                    @can('list-user')
                            <li class="nav-link {{$module_active == 'user'?'active':''}}">
                                <a href="{{url('admin/user/list')}}">
                                    <div class="nav-link-icon d-inline-flex">
                                        <i class="fad fa-users"></i>
                                    </div>
                                    Quản Lý Thành Viên
                                </a>
                                <i class="arrow fas fa-angle-right"></i>

                                <ul class="sub-menu">
                                    <li><a href="{{url('admin/user/add')}}">Thêm mới</a></li>
                                    <li><a href="{{url('admin/user/list')}}">Danh sách</a></li>
                                </ul>
                            </li>
                    @endcan
                    
                    @can('list-role')
                        <li class="nav-link {{$module_active == 'role'?'active':''}}">
                            <a href="{{url('admin/role/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                Quản Lý Vai Trò
                            </a>
                            <i class="arrow fas fa-angle-right"></i>

                            <ul class="sub-menu">
                                <li><a href="{{url('admin/role/add')}}">Thêm mới</a></li>
                                <li><a href="{{url('admin/role/list')}}">Danh sách</a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('list-role')
                        <li class="nav-link {{$module_active == 'permission'?'active':''}}">
                            <a href="{{route('permission.list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="fad fa-users-class"></i>
                                </div>
                                Quản Lý Nhóm Quyền
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                        </li>
                    @endcan
                </ul>
            </div>
            <div id="wp-content">
                @yield('content')
            </div>
        </div>


    </div>

    <script src="{{asset('/js/admin/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('/js/admin/myScript.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>