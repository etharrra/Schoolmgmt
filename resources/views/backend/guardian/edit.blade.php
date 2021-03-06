@extends('backendtemplate')
@section('content')
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-10">
					<h6 class="m-0 font-weight-bold text-primary">Guardian</h6>
				</div>
				<div class="col-md-2 col-sm-4 col-lg-2">
					<a href="{{route('guardian.index')}}" class="btn btn-block btn-outline-success">Back</a>
				</div>
			</div>
		</div>	
		<div class="card-body">
			<div class="row">
				<div class="col-12">
					<form action="{{ route('guardian.update',$guardian->id)}}" method="POST" enctype="multipart/form-data">

						@csrf
						@method('PUT')
						<div class="form-group  ">
							<label for="name" class="col-form-label"> Name </label>

							<div>
								<input type="text" class="form-control" id="name"  name="name" value="{{$guardian->user->name}}">

							</div>
						</div>

						<div class="form-group  ">
							<label for="email" class=" col-form-label"> Email </label>

							<div>
								<input type="email" name="email" class="form-control" id="email" value="{{$guardian->user->email}}">

							</div>
						</div>

						<div class="form-group  ">
							<label for="phone" class=" col-form-label"> Phone </label>

							<div>
								<input type="number" name="phone" class="form-control" id="phone"  value="{{$guardian->phone}}">

							</div>
						</div>				

						<div class="form-group">
							<label for="address" class=" col-form-label"> Address </label>

							<div>
								<textarea class="form-control" name="address" id="address">
									{{$guardian->address}}
								</textarea>				      		
							</div>
						</div>

						<input type="submit" name="submit" value="submit" class="btn btn-primary">	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection