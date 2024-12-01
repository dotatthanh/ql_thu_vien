<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Danh sách thành viên</title>
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	@include('layout.link')
</head>
<body>
    @include('admin.menu_admin')
    
    @yield('content')

    @include('layout.script')
	@yield('script')
</body>
</html>