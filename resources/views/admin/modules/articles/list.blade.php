@extends('admin.main')
@section('title-admin','Quản lý bài viết')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Quản lý bài viết</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Trang chủ</a></li>
                       <li class="breadcrumb-item active">Quản lý bài viết</li>
                   </ol>
				   <a href="{{ url('/dt-admin/articles/them') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm bài viết</a>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex">
                         <div>
                              <h5 class="card-title">Quản lý bài viết</h5>
                         </div>
                    </div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Tên</th>
									<th>Status</th>
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody>
								<?php if($articles != NULL){ ?>
									<?php $stt = 0; foreach($articles as $items){ $stt++; ?>
										<tr>
											<td class="text-center"><?=$stt?></td>
											<td>
												@php
													$catID = 0;
													$getCat = DB::table('articles_cat_articles')->where('ARTICLESID',$items->ID)->first();
													if($getCat){
														$catID = $getCat->ARTICLES_CATID;
													}
												@endphp
												<a href="{{ route('frontend.news.info',['urlpost' => Custom::get_url_alias('article_id='.$items->ID)]) }}" target="_blank"> {{ $items->NAME }}</a>
											</td>
											<td>
												<?php if($items->STATUS == 1) { ?>
													<a href="javscript:void(0)">Active</a>
												<?php } else { ?>
													<a href="javscript:void(0)">Not active</a>
												<?php } ?>
											</td>
											<td class="text-nowrap check-home">
												<a href="/dt-admin/articles/sua/<?=$items->ID?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
												<a href="/dt-admin/articles/xoa/<?=$items->ID?>" onclick="return confirm('Bạn có muốn xóa nội dung này không ?');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						 </table>
						 {{ $articles->appends(Request::except('page'))->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection