<button class="fa fa-bars btn-menu-admin"></button>
<header class="menu-admin">
	<button class="fa fa-arrow-left btn-close-admin"></button>
    <ul>
    	<li><a href="void:javascript(0)" class="lili">Quản lý</a>
    		<ul style="display: block;">
                <li><a href="{{ route('book_loans.index') }}">Mượn trả</a></li>
                @can('import_order')
                    <li><a href="{{ route('warehouses.index') }}">Nhập hàng</a></li>
                @endcan
    			{{-- @can('order_manage')
                    <li><a href="{{ route('orders.index') }}">Đơn đặt hàng</a></li>
                @endcan
                @can('sale_order_manage')
                    <li><a href="{{ route('orders.sales-orders') }}">Đơn bán hàng</a></li>
                @endcan
                @can('return_order_manage')
                    <li><a href="{{ route('return-order.index') }}">Đơn hàng trả lại</a></li>
                @endcan --}}
    			@can('type_manage')
                    <li><a href="{{ route('types.index') }}">Thể loại</a></li>
                @endcan
    			@can('category_manage')
                    <li><a href="{{ route('categorys.index') }}">Danh mục</a></li>
                @endcan
    			@can('author_manage')
                    <li><a href="{{ route('authors.index') }}">Tác giả</a></li>
                @endcan
    			@can('book_manage')
                    <li><a href="{{ route('books.index') }}">Sách</a></li>
                @endcan
    			{{-- @can('news_manage')
                    <li><a href="{{ route('news.index') }}">Tin tức</a></li>
                @endcan --}}
                @can('supplier_manage')
                    <li><a href="{{ route('suppliers.index') }}">Nhà cung cấp</a></li>
                @endcan
                @can('customer_manage')
                    <li><a href="{{ route('admin.customer.index') }}">Khách hàng</a></li>
                @endcan
                @can('staff_manage')
                    <li><a href="{{ route('admin.member.index') }}">Nhân viên</a></li>
                @endcan
                @can('role_manage')
                    <li><a href="{{ route('admin.role.index') }}">Vai trò</a></li>
                @endcan
                @can('permission_manage')
                    <li><a href="{{ route('admin.permission.index') }}">Quyền</a></li>
                @endcan
    		</ul>
            <i class="fa fa-angle-up btn-drop-admin" aria-hidden="true"></i>
    	</li>
    	{{-- <li><a href="void:javascript(0)" class="lili">Thống kê</a>
    		<ul>
                @can('warehouse_statistic')
                    <li><a href="{{ route('book-statistic') }}">Kho hàng</a></li>
                @endcan
                @can('sale_statistic')
                    <li><a href="{{ route('book-sold') }}">Hàng đã bán</a></li>
                @endcan
                @can('staff_revenue_statistic')
                    <li><a href="{{ route('staff-revenue') }}">Doanh thu nhân viên</a></li>
                @endcan
    			<li><a href="{{ route('contacts.index') }}">Phản hồi</a></li>
    		</ul>
            <i class="fa fa-angle-down btn-drop-admin" aria-hidden="true"></i>
    	</li> --}}
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