@extends('admin.main')
@section('title-admin','Cập nhật đánh giá')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Cập nhật đánh giá </h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active">Cập nhật đánh giá</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Cập nhật đánh giá</h4>
                </div>
				@if(count($errors) > 0)
				<div class="alert alert-danger">
					Upload Validation Error<br><br>
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			    @endif
			    @if($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>{{ $message }}</strong>
					</div>
				@endif
				<form method="post" enctype="multipart/form-data" action="{{ url('/dt-admin/review/edit/'.$rating->id) }}">
					{{ csrf_field() }}
					<div class="form-body">
								<div class="card-body">
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Sản phẩm</label>
												<input type="text" readonly value="{{ $rating->product->NAME }}" class="form-control" size="35" />
											</div>
										</div>
									</div>
									<div class="row pt-3">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tên người đánh giá</label>
												<input name="name_user" type="text" id="name_user" value="{{ $rating->name_user }}" class="form-control" size="35" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Số vote</label>
												<input name="vote" type="number" id="vote" value="{{ $rating->vote }}" class="form-control" min="1"/>
											</div>
										</div>
									</div>
									<div class="row pt-3">
										@php
											$imageLists = explode(',', $rating->images);
											$imageLists = array_filter($imageLists);
										@endphp
										<div class="col-lg-12 col-md-12">
											<div class="form-group">
												<label class="control-label">Ảnh</label>
												@if($imageLists)
												<div class="images-rating d-flex flex-wrap">
													@foreach($imageLists as $img)
														<div class="item" style="margin-right: 10px; margin-top: 10px">
															<img width="150" src="{{ asset('/storage/storage/rating/' . $img) }}" alt=""/>
															<div class="remove-img text-center mt-2 text-danger" 
															data-id="{{ $rating->id }}"
															data-name="{{ $img }}" 
															data-action="{{ route('rating.remove.image') }}" 
															style="cursor: pointer">
																<i class="fas fa-trash"></i>
															</div>
														</div>
													@endforeach
												</div>
												@endif
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label class="control-label">Thêm ảnh</label>
												<input type="file" name="image" class="form-control" />
											</div>
										</div>
									</div>
									<div class="row pt-3">
										<div class="col-md-6">
											<div class="form-group">
												<label>Trạng thái</label>
												<select name="status" class="form-control">
													<option value="1" @if($rating->status == 1) selected @endif>Hiển thị</option>
													<option value="0" @if($rating->status == 0) selected @endif>Ẩn</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Bình luận</label>
												<textarea name="comment" class="form-control form-control-danger" id="comment" cols="30" rows="10" placeholder="Content">{{ $rating->comment }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									</div>
								</div>
							
						<div class="form-actions">
                             <div class="card-body">
                                  <button type="submit" class="btn btn-success" name="ok"> <i class="fa fa-check"></i> Save</button>
                                  <button type="button" class="btn btn-dark">Cancel</button>
                             </div>
                       </div>
					 </div>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('admin-js')
	<script>
		$(document).ready(function(){
			$(document).on('click', '.remove-img', function(e){
				e.preventDefault();
				let self = $(this);
				let imageName = $(this).data('name');
				let id = $(this).data('id');
				console.log('dsdsd', $('meta[name="csrf-token"]').attr('content'));
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					method: 'POST',
					url: $(this).data('action'),
					data: {id, imageName},
					success: function (response) {
						if (response.error) {
							alert(response.message);
						}
						else{
							alert(response.message);
							self.parents().find('img').remove();
						}
					}
				});
			});
		});
	</script>
@endsection