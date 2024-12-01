<script src="{{ asset('js/jquery-2.2.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('js/select2.min.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('slick/slick.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/toastr/sweetalert2@10.js') }}"></script>
<script>
	CKEDITOR.replace("ckeditor", {
	    filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
	    filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
	    filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
	    filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
	    filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
	    filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
	} ); 
</script>
<script type="text/javascript">
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
</script>
<script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 5000,
		timerProgressBar: true,
		onOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	});
	
	@if(Session::has('alert-success'))
		Toast.fire({
			icon: 'success',
			title: "{{ Session::get('alert-success') }}"
		})
	@endif

	@if(Session::has('alert-error'))
		Toast.fire({
			icon: 'error',
			title: "{{ Session::get('alert-error') }}"
		})
	@endif
</script>
<script src="{{ asset('jquery-ui/jquery-ui.js') }}"></script>
