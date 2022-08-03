        <div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="{{url_plug()}}/assets/img/akun.png" alt="" />
							</div>
							<div class="info">
								<b class="caret pull-right"></b>{{Auth::user()->name}}
								<small>{{Auth::user()->role['name']}}</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
							<li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
							<li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
							<li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
						</ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav"><li class="nav-header">Navigation</li>
					
					<li>
						<a href="{{url('/')}}">
							<i class="fas fa-home"></i>
							<span>Home </span> 
						</a>
					</li>
					
					@if(Auth::user()->role_id==1)
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-bars"></i>
							<span>Master</span>
						</a>
						<ul class="sub-menu"  @if($menu=='master') style="display:block" @endif>
							<li><a href="{{url('Unit')}}">Unit Kerja</a></li>
							<li><a href="{{url('Pengguna')}}">Pengguna</a></li>
							<li><a href="{{url('Periode')}}">Periode</a></li>
							<li><a href="{{url('Sistem')}}">Sistem</a></li>
						</ul>
					</li>
					
					<li>
						<a href="{{url('/Audit')}}">
							<i class="fas fa-newspaper"></i>
							<span>Rencana Audit </span> 
						</a>
					</li>
					<li>
						<a href="{{url('/Temuan')}}">
							<i class="fas fa-newspaper"></i>
							<span>Temuan </span> 
						</a>
					</li>
					@endif
					
					@if(Auth::user()->role_id==2 || Auth::user()->role_id==4)
					<li>
						<a href="{{url('/Temuan')}}">
							<i class="fas fa-newspaper"></i>
							<span>Temuan </span> 
						</a>
					</li>
					
					@endif
					@if(Auth::user()->role_id==3 || Auth::user()->role_id==5 )
					<li>
						<a href="{{url('/Temuan')}}">
							<i class="fas fa-newspaper"></i>
							<span>Temuan </span> 
						</a>
					</li>
					@endif
					<li>
						<a href="{{url('/Help')}}">
							<i class="fas fa-info-circle"></i>
							<span>Help </span> 
						</a>
					</li>
					<li>
						<a href="{{url('/Book')}}">
							<i class="fas fa-book"></i>
							<span>Manual Book </span> 
						</a>
					</li>
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>