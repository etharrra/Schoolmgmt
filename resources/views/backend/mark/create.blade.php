@extends('backendtemplate')
@section('content')
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-10">
					<h6 class="m-0 font-weight-bold text-primary">Mark</h6>
				</div>
				<div class="col-md-2 col-sm-4 col-lg-2">
					<a href="{{route('mark.index')}}" class="btn btn-block btn-outline-success">back</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12">
					<form action="{{ route('mark.store')}}" method="POST" enctype="multipart/form-data">

						@csrf
						
						<div class="form-group  ">
							<label for="month" class="col-form-label"> Month </label>

							<div>
								<select id="month" class="form-control" name="month">
									<option value="june">June</option>
									<option value="july">July</option>
									<option value="august">August</option>
									<option value="september">September</option>
									<option value="october">October</option>
									<option value="november">November</option>
									<option value="december">December</option>
									<option value="january">January</option>
									<option value="february">February</option>
								</select>
								@error('month')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-6">
									<label for="grade">Select Grade</label>
									<select name="grade" id="grade" class="form-control">
										<option selected=""><---Select Grade---></option>
											@php $v = $rooms @endphp
											@foreach($v as $value)
											<option value="{{$value->grade->id}}" data-id="{{$value->grade->id}}">{{$value->grade->name}}</option>
											@break
											@endforeach
										</select>

									</div>
									<div class="col-6">
										<label for="room">Select Room</label>
										<select name="room" id="room" class="form-control">

										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="subject">Select Subject</label>
								<select name="subject" id="subject" class="form-control">
									<option value="{{$subjectid}}">{{$subjects}}</option>
								</select>	
							</div>	
							<div class="form-group">					
								<ul class="list-group" id="student_list">

								</ul>
							</div>
						

						<input type="submit" name="submit" value="submit" class="btn btn-primary">	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('script')
<script type="text/javascript">
	$(document).ready(function() {

    $('.js-example-basic-multiple').select2();
    	$('#grade').change(
   		function() {
   			// alert("ok");
   			var id = $( 'option:selected', this ).data( 'id' );
   			//alert(id);
   			$.get('/getroom/'+id, function(res) {
   				$room = res;
   				var html='<option selected=""><---Select Room---></option>';
   				$.each($room, function(i, v) {
   					// console.log(v.name);
   					// console.log(v.id);
   					var rname = v.name;
   					var rid = v.id;
   					html += `<option value="${rid}" data-id="${rid}">${rname}</option>`;

   				});
   				$('#room').html(html);
   			});

   			$.get('/getsubject/'+id, function(res) {
   				$subject = res;
   				var html='<option selected=""><---Select Subject---></option>';
   				$.each($subject, function(i, v) {
   					// console.log(v.name);
   					// console.log(v.id);
   					var sname = v.subname;
   					var sid = v.subject_id;
   					html += `<option value="${sid}">${sname}</option>`;

   				});
   				// $('#subject').html(html);
   			});
   		});
    	$('#room').change(
    		
    		function() {

    			var id = $( 'option:selected', this ).data( 'id' );
   			//alert(id);
   			$.get('/getstudent/'+id, function(res) {
   				var student = res;
   				// console.log(student);
   				for (var i = 0; i < student.length; i++) {
   					student[i]["mark"] = null;
   				}
   				// console.log(student);
   				var mark = localStorage.getItem("mymark");
   				var exit = 0;
   				
				if (!exit) {
					localStorage.clear();
				}
				mark = JSON.stringify(student);
				localStorage.setItem("mymark", mark);

   				var html=''; var i = 0; var n = 0;var o =0;
   				$.each(student, function(i, v) {

   					// console.log(v.name);
   					// console.log(v.id);
   					var stname = v.name;
   					var stid = v.id;
   					// console.log(stid);
   					html += `
   					<li class="list-group-item">
	   					<div class="row">
		   					<div class="col-4 text-center">
			   					<label class="form-check-label text-success" for="${i++}">
			   					${stname}
			   					</label>
			   					
			   				</div>
			   				<div class="col-8">
			   					<input type="text" name="mark" class="form-control mark" id="${n++}" data-stduentid="${stid}">
		   					</div>
	   					</div>
   					</li>`;
   					var studentid = $('.hi'+stid).val();
   				});
   				$('#student_list').html(html);
   				
   				$('.mark').change(function(e){

   						e.preventDefault();

   						var studentid = $(this).data('stduentid');
   						var markvalue = $(this).val();
   						// var o =0;
   						// var studentid=$(".hi"+o).val();
   						// console.log(studentid);
   						// console.log(markvalue);
   						var mark = localStorage.getItem("mymark");
   								var mymark=JSON.parse(mark);
   								$.each(mymark, function(i, v) {
   									
   									
   										if(v.id==studentid){
   											// alert("Ok");
   										v.mark=markvalue;
   										
   									}
   								});	
   								mark = JSON.stringify(mymark);
								localStorage.setItem("mymark", mark);
   					
   				}); 							

   			});
   		});
    	$("form").submit(function(e){
	    		e.preventDefault();
	   		//alert("OK");
	   		$.ajaxSetup({
	   			headers: {
	   				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	   			}
	   		});
	   		var month = $('#month').val();
	   		var subject = $('#subject').val();
	   		var mark = localStorage.getItem("mymark");
	   		var mymark = JSON.parse(mark);
	   		var url = 
	   		$.post('/backend/mark/', {month:month,mymark:mymark,subject:subject}, 
	   			function(response) {
	   				if (response) {
	   					alert("Successfully!");
	   					localStorage.clear();
	   					// window.location.replace('mark/index');
	   				}
	   			});
	   	});
    
});
</script>
@endsection