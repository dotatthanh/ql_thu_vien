<button class="fa fa-bars btn-menu-admin"></button>
<header class="menu-admin">
	<button class="fa fa-arrow-left btn-close-admin"></button>
    <ul>
    	<li><a href="void:javascript(0)" class="lili">Quản lý</a>
    		<ul style="display: block;">
                @can('Quản lý mượn trả sách')
                <li><a href="{{ route('book_loans.index') }}">Mượn trả sách</a></li>
                @endcan
                @can('Quản lý nhập hàng')
                    <li><a href="{{ route('warehouses.index') }}">Nhập hàng</a></li>
                @endcan
    			@can('Quản lý thể loại')
                    <li><a href="{{ route('types.index') }}">Thể loại</a></li>
                @endcan
    			@can('Quản lý danh mục')
                    <li><a href="{{ route('categorys.index') }}">Danh mục</a></li>
                @endcan
    			@can('Quản lý tác giả')
                    <li><a href="{{ route('authors.index') }}">Tác giả</a></li>
                @endcan
    			@can('Quản lý sách')
                    <li><a href="{{ route('books.index') }}">Sách</a></li>
                @endcan
                @can('Quản lý nhà cung cấp')
                    <li><a href="{{ route('suppliers.index') }}">Nhà cung cấp</a></li>
                @endcan
                @can('Quản lý khách hàng')
                    <li><a href="{{ route('admin.customer.index') }}">Khách hàng</a></li>
                @endcan
                @can('Quản lý nhân viên')
                    <li><a href="{{ route('admin.member.index') }}">Nhân viên</a></li>
                @endcan
                @can('Quản lý vai trò')
                    <li><a href="{{ route('admin.role.index') }}">Vai trò</a></li>
                @endcan
                @can('Quản lý quyền')
                    <li><a href="{{ route('admin.permission.index') }}">Quyền</a></li>
                @endcan
    		</ul>
            <i class="fa fa-angle-up btn-drop-admin" aria-hidden="true"></i>
    	</li>
    	<li><a href="void:javascript(0)" class="lili">Thống kê</a>
    		<ul>
                @can('Thống kê kho hàng')
                    <li><a href="{{ route('book-statistic') }}">Kho hàng</a></li>
                @endcan
    		</ul>
            <i class="fa fa-angle-down btn-drop-admin" aria-hidden="true"></i>
    	</li>
        <li>
            <a href="{{ route('admin.profile') }}">
                Thông tin cá nhân
            </a>
        </li>
    	<li>
            <a href="{{ route('logout') }}" onclick="
                event.preventDefault();
                document.getElementById('logout-form').submit();">
                Đăng xuất
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    	
    </ul>
</header>