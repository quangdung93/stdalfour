<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
						<li>
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Sản phẩm</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="{{ route('admin.product.list') }}">Sản phẩm</a></li>
								<li><a href="{{ route('admin.category.list') }}">Danh mục</a></li>
                            </ul>
                        </li>
						<li>
							<a class="waves-effect waves-dark" href="{{ Route('admin.order.list') }}" aria-expanded="false">
								<i class="ti-shopping-cart"></i><span class="hide-menu">Đơn hàng</span>
							</a>
                        </li>
						<li>
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-write"></i><span class="hide-menu">Tin tức</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="{{ route('admin.news.list') }}">Tin tức</a></li>
								<li><a href="{{ route('admin.category.news.list') }}">Danh mục</a></li>
                            </ul>
                        </li>
						<li>
							<a class="waves-effect waves-dark" href="{{ Route('admin.articles.list') }}" aria-expanded="false">
								<i class="ti-notepad"></i><span class="hide-menu">Bài viết</span>
							</a>
                        </li>
                        <li>
							<a class="waves-effect waves-dark" href="{{ Route('contact.list.add') }}" aria-expanded="false">
								<i class="ti-email"></i><span class="hide-menu">Liên hệ</span>
							</a>
                        </li>
						<li>
							<a class="waves-effect waves-dark" href="{{ Route('review.list.add') }}" aria-expanded="false">
								<i class="ti-pencil-alt"></i><span class="hide-menu">Bình luận</span>
							</a>
                        </li>
						<li>
							<a class="waves-effect waves-dark" href="{{ Route('slider.list') }}" aria-expanded="false">
								<i class="ti-gallery"></i><span class="hide-menu">Slider</span>
							</a>
                        </li>
						<li>
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Cài đặt</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="/dt-admin/setting/sua/1">Cài đặt trang</a></li>
								<li><a href="{{ route('userlist') }}">Quản trị viên</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>