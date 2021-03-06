@extends('backendtemplate')
@section('content')
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-10">
					<h6 class="m-0 font-weight-bold text-primary">Teacher</h6>
				</div>
				<div class="col-md-2 col-sm-4 col-lg-2">
					<a href="{{route('teacher.index')}}" class="btn btn-block btn-outline-success">back</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12">
					<form action="{{ route('teacher.store')}}" method="POST" enctype="multipart/form-data">

					@csrf
						<div class="form-group  ">
							<label for="name" class="col-form-label"> Name </label>

								<div>
									<input type="text" class="form-control" id="name"  name="name">
									@error('name')
									<div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
						</div>
					
					<div class="form-group">
						<label for="avatar" class="form-control-label"> Profile</label>

						<div>
							<input type="file" id="avatar" name="avatar" class="form-control-file">	
							@error('avatar')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
					</div>

					<div class="form-group  ">
						<label for="email" class=" col-form-label"> Email </label>

						<div>
							<input type="email" name="email" class="form-control" id="email">
							@error('email')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
					</div>

					<div class="form-group  ">
						<label for="phone" class=" col-form-label"> Phone </label>

						<div>
							<input type="number" name="phone" class="form-control" id="phone" >
							@error('phone')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
					</div>

					<div class="form-group  ">
						<label for="degree" class=" col-form-label"> Education </label>

						<div>
							<input type="text" name="education" class="form-control">
							@error('education')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
					</div>

					

					<div class="form-group  {{ $errors->has('address') ? ' has-error' : '' }}">
						<label for="address" class=" col-form-label"> Address </label>


						<div>
							<textarea class="form-control" name="address" id="address">

							</textarea>
							@error('address')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>

				    	
				    
				    </div>
				    <div class="form-group">
						<label for="grade">Select Grade</label>
						<select name="grade" id="grade" class="form-control">
							<option selected=""><---Select Grade---></option>
							@foreach($grades as $grade)
							<option value="{{$grade->id}}" data-id="{{$grade->id}}">{{$grade->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="subject_id">Select Subject</label>
						<select name="subject_id" id="subject_id" class="form-control">

						</select>	
					</div>
					<div class="form-group">
						<label class="form-control-label" for="room">Select Room</label>						
						<select class="js-example-basic-multiple form-control" id="room" name="rooms[]" multiple="multiple">
								
						</select>
					</div>
					<input type="submit" name="submit" value="submit" class="btn btn-primary">
					
					
				</form>

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
   				var html;
   				$.each($room, function(i, v) {
   					// console.log(v.name);
   					// console.log(v.id);
   					var rname = v.name;
   					var rid = v.id;
   					html += `<option value="${rid}">${rname}</option>`;

   				});
   				$('#room').html(html);
   			});

   			$.get('/getsubject/'+id, function(res) {
   				$subject = res;
   				var html;
   				$.each($subject, function(i, v) {
   					// console.log(v.name);
   					// console.log(v.id);
   					var sname = v.subname;
   					var sid = v.subject_id;
   					html += `<option value="${sid}">${sname}</option>`;

   				});
   				$('#subject_id').html(html);
   			});
   		});
    
});
</script>
@endsection