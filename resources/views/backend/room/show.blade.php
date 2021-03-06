@extends('backendtemplate')
@section('content')
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-10">
					<h6 class="m-0 font-weight-bold text-primary">Room</h6>
				</div>
				<div class="col-2">
					<a href="{{route('room.index')}}" class="btn btn-block btn-outline-success">Back</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="">
					<thead>
						<tr>
							<th>Day</th>
							<th>9:00-9:45</th>
							<th>9:45-10:30</th>
							<th>10:30-11:15</th>
							<th>11:15-12:00</th>
							<th>1:00-1:45</th>
							<th>1:45-2:30</th>
							<th>2:30-3:15</th>				
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Monday</th>
							@foreach($tmon as $row)
								<td>{{$row->subname}}</td>
							@endforeach
						</tr>
						<tr>
							<th>Tuesday</th>
							@foreach($ttue as $row)
								<td>{{$row->subname}}</td>
							@endforeach							
						</tr>
						<tr>
							<th>Wednesday</th>
							@foreach($twed as $row)
								<td>{{$row->subname}}</td>

							@endforeach

						</tr>
						<tr>
							<th>Thursday</th>
							@foreach($tthurs as $row)
								<td>{{$row->subname}}</td>

							@endforeach	

						</tr>
						<tr>
							<th>Friday</th>
							@foreach($tfri as $row)
								<td>{{$row->subname}}</td>
							@endforeach
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Day</th>
							<th>9:00-9:45</th>
							<th>9:45-10:30</th>
							<th>10:30-11:15</th>
							<th>11:15-12:00</th>
							<th>1:00-1:45</th>
							<th>1:45-2:30</th>
							<th>2:30-3:15</th>				
						</tr>
					</tfoot>
				</table>				
			</div>
						
		</div>
	</div>
</div>	
@endsection