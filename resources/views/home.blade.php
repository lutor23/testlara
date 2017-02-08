@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Home 
						<br>
						<h4>
							<div class="quote">
								{{ Illuminate\Foundation\Inspiring::quote() }}	
							</div>
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

