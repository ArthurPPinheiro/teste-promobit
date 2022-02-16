@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card w-100 h-100 m-4">
                <div class="card-header d-flex align-items-center justify-content-between bg-white border-0">
                    <h3>Tags</h3>
					<a href="{{ route('Admin.Tags.create') }}" class="btn btn-sm btn-dark">Create</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
								@foreach ((new Modules\Tags\Entities\Tag())->getFillable() as $fillable)
									<th scope="col" class="sort" data-sort="{{ Str::slug($fillable) }}"> {{ $fillable }}</th>
								@endforeach
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($tags as $tag)
								<tr>
									@foreach ((new Modules\Tags\Entities\Tag())->getFillable() as $fillable)
										<td class="budget">
											{{ $tag->$fillable }}
										</td>
									@endforeach
									<td class="text-center nowrap">
										<a class="btn btn-icon-only text-blue"
											href="{{ route('Admin.Tags.edit', $tag) }}">
											<i class="fas fa-edit text-info"></i>
										</a>
										<a class="btn btn-icon-only text-red"
											href="{{ route('Admin.Tags.delete', $tag) }}">
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
