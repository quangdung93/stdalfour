@extends('admin.main')
@section('title-admin','Quản lý trang slider')

@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Slider</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Trang chủ</a></li>
                       <li class="breadcrumb-item active">Slider</li>
                   </ol>
				   <a href="{{route('slider.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm Slider</a>
              </div>
        </div>
    </div>
    <div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex">
                         <div>
                              <h5 class="card-title">Slider</h5>
                         </div>
                    </div>
					<div class="table-responsive">
						<table id="datatable" class="collaptable table table-bordered table-hover">
							<thead>
							<tr>
								<th style="text-align: center; vertical-align: middle;">...</th>
								<th style="text-align: left; vertical-align: middle;">Tiêu đề</th>
								<th style="text-align: left; vertical-align: middle;">Hình slide</th>
								<th style="text-align: center; vertical-align: middle;">Trạng thái</th>
								<th style="text-align: center; vertical-align: middle;">...</th>
							</tr>
							</thead>
							<tbody>
							@foreach($slider as $key=>$value)
								<tr>
									<td style="text-align: center; vertical-align: middle;">
										@if($value->position == 0 || $value->position >= 6)
											<i class="fa fa-circle" style="color: gray"></i>
										@else
											{!! $value->position !!}
											@endif
									</td>
									<td style="text-align: left; vertical-align: middle;">
										{{ $value->title }}
									</td>
									<td style="text-align: center; vertical-align: middle;">

										<img src="{{url('images/slider/'.$value->image)}}" style="max-width: 100px;max-height: 100px" class="img-thumbnail" alt="">
									</td>

									<td style="text-align: center; vertical-align: middle;">
										{!! Custom::getStatus($value->status,'Hiển thị','Ẩn') !!}
									</td>
									<td style="text-align: center; vertical-align: middle;">
										@if(!$value->role)
											<div class="btn-group group-{{$value->id}}" role="group">
												<a href="slider/{{$value->id}}/edit" class="btn btn-primary btn-icon"><div class="sm"><i class="fas fa-edit"></i></div></a>&nbsp;
												<a onclick="return confirm('Bạn có chắc chắn muốn xóa slide này?')"
												   href="{!! URL::route('slider.delete',$value->id) !!}"  class="btn btn-danger btn-icon"><div class="sm" style="color:white"><i class="fas fa-trash-alt"></i></div></a>
											</div>
										@else
											<i class="fa fa-ban"></i>
										@endif
									</td>
								</tr>
							@endforeach
							</tbody>
							<tfoot>
							<tr>
								<th style="text-align: center; vertical-align: middle;">...</th>
								<th style="text-align: left; vertical-align: middle;">Tiêu đề</th>
								<th style="text-align: left; vertical-align: middle;">Hình slide</th>
								<th style="text-align: center; vertical-align: middle;">Trạng thái</th>
								<th style="text-align: center; vertical-align: middle;">...</th>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection