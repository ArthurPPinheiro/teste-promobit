@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card w-100 h-100 m-4">
                <div class="card-header d-flex align-items-center justify-content-between bg-white border-0">
                    <h3>Users</h3>
					<a href="{{ route('Admin.Users.create') }}" class="btn btn-sm btn-dark">Criar</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
								@foreach ((new Modules\Users\Entities\User())->getFillable() as $fillable)
									<th scope="col" class="sort" data-sort="{{ Str::slug($fillable) }}"> {{ $fillable }}</th>
								@endforeach
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($users as $user)
								<tr>
									@foreach ((new Modules\Users\Entities\User())->getFillable() as $fillable)
										<td class="budget">
											{{ $user->$fillable }}
										</td>
									@endforeach
									<td class="text-center nowrap">
										<a class="btn btn-icon-only text-blue"
											href="{{ route('Admin.Users.edit', $user) }}">
											<i class="fas fa-edit text-info"></i>
										</a>
										<a class="btn btn-icon-only text-red"
											href="{{ route('Admin.Users.delete', $user) }}">
											<i class="fas fa-trash text-danger"></i>
										</a>
									</td>
								</tr>
							@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
