// var Add_Book_Category = function(){
// 	$('.add-test').click(function(event) {

// 		$.ajax({
// 			url: 'bookcategorys/store',
// 			type: 'POST',
// 			dataType: 'json',
// 			data: {
// 				name: $('#name').val()
// 			},
// 		})
// 		.done(function() {
// 			console.log("success");
// 		})
// 		.fail(function() {
// 			console.log("error");
// 		})
// 		.always(function() {
// 			console.log("complete");

// 			content = '<tr>';
// 			content += '<td class="text-center align-middle">{{ $stt++ }}</td>';
// 			content += '<td class="align-middle">'+ $('#name').val() +'</td>';
// 			// content += '<td class="text-center">';
// 			// content += '<button class="btn btn-warning text-white w-25" data-toggle="modal" data-target="#edit_category_book">Sửa</button>';
// 			// content += '<form action="{{ route("bookcategorys.destroy", $bookcategory->id) }}" method="POST">';
// 			// content += "@csrf";
// 			// content += '@method("DELETE")';
// 			// content += '<button type="submit" class="btn btn-danger w-25">Xóa</button>';
// 			// content += '</form>';
// 			// content += '</td>';
// 			content += '</tr>';

// 			$('.test').append(content);
// 				$('#name').val('');
// 		});
// 	});
// }



// $(function(){
// 	Add_Book_Category();
// })