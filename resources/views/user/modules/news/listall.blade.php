@extends('user.layout.master')
@section('content')
	<div class="section-blog pt-5 pb-5"> 
    <div class="container">
      <ul class="nav" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="blog1-tab" data-bs-toggle="tab" data-bs-target="#blog1" type="button" role="tab" aria-controls="blog1" aria-selected="true">Đang hot</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="blog2-tab" data-bs-toggle="tab" data-bs-target="#blog2" type="button" role="tab" aria-controls="blog2" aria-selected="true">Xem nhiều nhất</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="blog3-tab" data-bs-toggle="tab" data-bs-target="#blog3" type="button" role="tab" aria-controls="blog3">mới nhất</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="blog4-tab" data-bs-toggle="tab" data-bs-target="#blog4" type="button" role="tab" aria-controls="blog4">trị mụn  </button>
        </li>
      </ul>
      <div class="tab-content mt-5">
        <div class="tab-pane fade show active" id="blog1" role="tabpanel" aria-labelledby="blog1-tab" tabindex="0">
          <div class="row">
		  @foreach($news as $tin)
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="{{ $tin->IMAGE }}" alt="">
                  <h4 class="card-title">{{ $tin->NAME }}</h4>
                  <p>{{ $tin->SUMMARY }}</p>
				  <p><a href="/tin-tuc/{{ Custom::get_url_alias('news_id='.$tin->NEWSID) }}">read more</a></p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			@endforeach

          </div>
		  <a class="more text-center text-uppercase d-block">load more</a>
        </div>
		
		
        <div class="tab-pane fade" id="blog2" role="tabpanel" aria-labelledby="blog2-tab" tabindex="0">
          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img1.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img2.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img3.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img4.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img5.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img6.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><a class="more text-center text-uppercase d-block">load more</a>
        </div>
        <div class="tab-pane fade" id="blog3" role="tabpanel" aria-labelledby="blog3-tab" tabindex="0">
          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img1.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img2.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img3.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img4.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img5.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img6.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><a class="more text-center text-uppercase d-block">load more</a>
        </div>
        <div class="tab-pane fade" id="blog4" role="tabpanel" aria-labelledby="blog4-tab" tabindex="0">
          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img1.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img2.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img3.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img4.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img5.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body"><img class="mb-3 img-fluid" src="img/blog/img6.jpg" alt="">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sew ff ...</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis </p>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-left d-flex align-items-center">
                      <div class="like d-flex align-items-center"><img src="img/blog/icon1.svg" alt=""><span>4</span></div>
                      <div class="comments d-flex align-items-center"><img src="img/blog/icon2.svg" alt=""><span>10</span></div>
                      <div class="view d-flex align-items-center"><img src="img/blog/icon3.svg" alt=""><span>6</span></div>
                    </div>
                    <div class="d-right">
                      <div class="share d-flex align-items-center"><img src="img/blog/icon4.svg" alt=""><span>share</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><a class="more text-center text-uppercase d-block">load more</a>
        </div>
      </div>
    </div>
  </div>
@endsection