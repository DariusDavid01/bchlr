@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit blog post</h4>
			</div>
			<!-- /.box-header -->
    <div class="box-body">
    <div class="row">
        <div class="col">
            <form method="post" action="{{route('blog.post.update')}}">
                @csrf
               <input type="hidden" name="id" value="{{$post->id}}">
            <div class="row">
                <div class="col-12">	

                    <div class="row"> <!-- start 2nd row -->
                       
                        <div class="col-md-6">
                        <div class="form-group">
                        <h5>Post title En <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="post_title_en" class="form-control" required="" value="{{$post->post_title_en}}">
                                    @error('post_title_en')
						<span class="text-danger">{{$message}}</span>
						@enderror</div></div>
                        </div> <!-- end col md 4 -->
                        <div class="col-md-6">
                        <div class="form-group">
                        <h5>Post title Ro <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="post_title_ro" class="form-control" required="" value="{{$post->post_title_ro}}">
                                    @error('post_title_ro')
						<span class="text-danger">{{$message}}</span>
						@enderror</div></div>
                        </div> <!-- end col md 4 -->
                    </div> <!-- end 2nd row-->
                    
                    <div class="row"> <!-- start 6th row -->
                    <div class="col-md-12">
                        <div class="form-group">
								<h5>Blog category select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control" required="">
										<option value="" selected="" disabled="">Select the blog category</option>
                                        @foreach($blogcategory as $category)
										<option value="{{$category->id}}" {{$category->id == $post->category_id ? 'selected':''}}>{{$category->blog_category_name_en}}</option>
                                        @endforeach
									</select>
                                    @error('category_id')
						<span class="text-danger">{{$message}}</span>
						@enderror
								</div>
							</div>
                        </div> <!-- end col md 4 -->


                        <!-- <div class="col-md-6">
                        <div class="form-group">
                        <h5>Post main image <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="file" name="post_image" class="form-control" onChange="mainThumbUrl(this)" required="">
                                    @error('post_image')
						<span class="text-danger">{{$message}}</span>
						@enderror
                        <div><img src="" id="mainThmb"></div>
                            </div></div>
                        </div> -->
                         <!-- end col md 4 -->

                    </div> <!-- end 6th row-->



                    <div class="row"> <!-- start 8th row -->
                        <div class="col-md 6">
                        <div class="form-group">
                        <h5>Post details English <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <textarea name="post_details_en" id="editor1" rows="10" cols="80" required="">{!!$post->post_details_en!!}</textarea>
                        </div>
                        </div>
                        </div> <!-- end col md 6 -->


                        <div class="col-md 6">
                        <div class="form-group">
                        <h5>Post details Romanian <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <textarea name="post_details_ro" id="editor2" rows="10" cols="80" required="">{!!$post->post_details_ro!!}</textarea>
                        </div>
                        </div>
                        </div> <!-- end col md 6 -->


                    </div> <!-- end 8th row-->

                    <hr>

                </div>
            </div>
                <div class="text-xs-right">
                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Post"></button>
                </div>
            </form>

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>

        <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box bt-3 border-info">
				  <div class="box-header">
					<h4 class="box-title">Post image <strong>Update</strong></h4>
				  </div>
                    <form method="post" action="{{route('blog.post.image.update')}}" enctype="multipart/form-data">
                        @csrf
               <input type="hidden" name="id" value="{{$post->id}}">
               <input type="hidden" name="old_img" value="{{$post->post_image}}">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                
                            <div class="card" style="width: 780px;">
  <img src="{{asset($post->post_image)}}" class="card-img-top" style="height:433px; width:780px;">
  <div class="card-body">
    <p class="card-text"><div class="form-group"><label class="form-control-label">Change image <span class="tx-danger">*</span></label>
        <input class="form-control" type="file" name="post_image" onChange="mainThumbUrl(this)" > <img src="" id="mainThmb">
</div></p>
  </div>
</div>



                            </div> <!--end col md3 -->
                        </div>
                        <div class="text-xs-right">
                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image"></button>
                </div><br><br>
                    </form>
				</div>
			  </div>
        </div> <!-- end row -->
    </section>
		<!-- /.content -->
	  </div>

    <script type="text/javascript">
        function mainThumbUrl(input){
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThmb').attr('src',e.target.result).width(780).height(433);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
   
@endsection