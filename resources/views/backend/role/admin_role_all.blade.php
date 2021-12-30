@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Admins List</h3>
				  <a href="{{route('add.admin')}}" class="btn btn-danger" style="float:right">Add admin</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Image</th>
								<th>Name</th>
								<th>Email</th>
								<th>Access</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($admin as $item)
							<tr>
								<td><img src="{{asset($item->profile_photo_path)}}" style="width:50px; height:50px"></td>
								<td>{{$item->name}}</td>
								<td>{{$item->email}}</td>
								<td>
									@if($item->brand==1)
									<span class="badge btn-primary">Brand</span>
									@endif
									@if($item->category==1)
									<span class="badge btn-secondary">Category</span>
									@endif
									@if($item->product==1)
									<span class="badge btn-success">Product</span>
									@endif
									@if($item->slider==1)
									<span class="badge btn-danger">Slider</span>
									@endif
									@if($item->coupons==1)
									<span class="badge btn-warning">Coupons</span>
									@endif
									@if($item->shipping==1)
									<span class="badge btn-info">Shipping</span>
									@endif
									@if($item->blog==1)
									<span class="badge btn-secondary">Blog</span>
									@endif
									@if($item->setting==1)
									<span class="badge btn-success">Setting</span>
									@endif
									@if($item->returnorder==1)
									<span class="badge btn-danger">Return Order</span>
									@endif
									@if($item->review==1)
									<span class="badge btn-warning">Review</span>
									@endif
									@if($item->orders==1)
									<span class="badge btn-info">Orders</span>
									@endif
									@if($item->stock==1)
									<span class="badge btn-secondary">Stock</span>
									@endif
									@if($item->reports==1)
									<span class="badge btn-danger">Reports</span>
									@endif
									@if($item->alluser==1)
									<span class="badge btn-dark">All Users</span>
									@endif
									@if($item->adminuserrole==1)
									<span class="badge btn-light">Admin User Role</span>
									@endif
								</td>
								<td><a href="{{route('edit.admin.user',$item->id)}}" class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('delete.admin.user',$item->id)}}" class="btn btn-danger" title="Delete" id="delete"><i class="fa fa-trash"></i></a></td>
							</tr>
							@endforeach
						</tbody>
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

			  <!-- /.box -->          
			</div>
			<!-- /.col -->

            
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
<!-- /.content-wrapper -->

@endsection