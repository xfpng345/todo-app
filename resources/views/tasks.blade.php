@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4>作成</h4>
				</div>
				<div class="panel-body">
					@include('commons.errors')
					<form action="/task" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="task-name" class="col-sm-3 control-label"></label>
							<div class="col-sm-6">
								<input type="text" name="title" id="task-name" class="form-control" value="{{ old('task') }}">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-plus"></i>トレーニングを追加する
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<h4>検索</h4>
				<form action="{{url('/')}}" method="GET" class="form-horizontal">
					{{ csrf_field() }}
					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="form-control">
						</div>
				</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
						<input type="submit" value="検索" class="btn btn-primary">
						</div>
					</div>
				</form>
			@if (count($tasks) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						トレーニング一覧
					</div>
					<div class="panel-body">
						<table class="table table-striped task-table">
							<thead>
								<th>task</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								@foreach ($tasks as $task)
									<tr>
										<td class="table-text">
											<a href="{{ action('UserController@show', $task->user_id) }}">
												<div>{{ $task->user->name }}</div>
											</a>
											<div>{{ $task->title }}</div>
										</td>
										@auth
											@if( ( $task->user_id ) == ( Auth::user()->id ) )
												<td>
													<form action="/task/{{ $task->id }}" method="POST">
														{{ csrf_field() }}
														{{ method_field('DELETE') }}
														<button type="submit" class="btn btn-danger">
															<i class="fa fa-trash"></i>削除
														</button>
													</form>
												</td>
											@endif
										@endauth
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection