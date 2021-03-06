@extends('backendtemplate')
@section('content')
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-10">
					<h6 class="m-0 font-weight-bold text-primary">Subject</h6>
				</div>
				<div class="col-md-2 col-sm-4 col-lg-2">
					<a href="{{route('subject.index')}}" class="btn btn-block btn-outline-success">back</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12">
					<form action="{{ route('subject.store')}}" method="POST">
						@csrf
						<div class="form-group">
							<label for="academicyear" class="form-control-label">Academic Year</label>
							<input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
							@error('subject')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">	
							<label for="grade" class="form-control-label">Grade</label>							
							<select class="js-example-basic-multiple form-control" name="grades[]" multiple="multiple">
								@foreach($grades as $row)
								<option value="{{$row->id}}">{{$row->name}}</option>
								@endforeach
							</select>
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

	});
</script>
@endsection