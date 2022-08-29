@extends('admin.main')
@section('title-admin','Quản lý trang liên hệ')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Danh sách liên hệ</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Trang chủ</a></li>
                       <li class="breadcrumb-item active">Danh sách liên hệ</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex">
                         <div>
                              <h5 class="card-title">Danh sách liên hệ</h5>
                         </div>
                    </div>
					
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center">STT</th>
									<th>Ngày gửi</th>
									<th>Người liên hệ</th>
									<th>Email</th>
									<th>Số điện thoại</th>
									<th>Nội dung tin nhắn</th>
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody>
								<?php if($contact != NULL){ ?>
									<?php $stt = 0; foreach($contact as $items){ $stt++; ?>
										<tr>
											<td class="text-center"><?=$stt?></td>
											<td><?=$items->contact_date?></td>
											<td><?=$items->contact_email?></td>
											<td><span class="badge badge-success badge-pill"><?=$items->contact_name?></span> </td>
											<td><span class="text-success"><?=$items->contact_phone?></span></td>
											<td>
												<p><?=$items->contact_title?></p>
												<?=$items->contact_note?>
											</td>
											<td class="text-nowrap check-home">
												<a href="/dt-admin/contact/xoa/<?=$items->contact_id?>" onclick="return confirm('Bạn có muốn xóa nội dung này không ?');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						 </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection