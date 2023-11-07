@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Edit Blog</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
						<li class="breadcrumb-item active">Edit Blog</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">

						<!-- Add details -->
						<div class="row">
							<div class="col-12 blog-details">
								<form id="addBlogForm" enctype="multipart/form-data">
									@csrf
									<input type="hidden" id="storeRoute" value="{{ route('admin.blog.update', $blog->id) }}">
									<div class="form-group">
										<label>Blog Name</label>
										<input class="form-control" type="text" name="name" value="{{$blog->name}}">
									</div>
									<div class="form-group">
										<label>Blog Images</label>
										<div>
											<input class="form-control" type="file" name="image">
											<small class="form-text text-muted">Max. file size: 50 MB. Allowed images: jpg, gif, png. Maximum 10 images only.</small>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Blog Category</label>
												<select class="select select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true" name="category">
													<option>Web Design</option>
													<option>Web Development</option>
													<option>App Development</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Blog Sub Category</label>
												<select class="select select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true" name="sub_category">

													<option>Html</option>
													<option>Css</option>
													<option>Javascript</option>
													<option>PHP</option>
													<option>Codeignitor</option>
													<option>iOS</option>
													<option>Android</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Blog Description</label>
										<textarea cols="30" rows="6" class="form-control" name="description">{{$blog->description}}</textarea>

									</div>
									<div class="form-group">
										<label class="display-block w-100">Blog Status</label>
										<div>
											<div class="form-check form-radio form-check-inline">
												<input class="form-check-input" id="active" name="status" value="active" type="radio" checked="">
												<label class="form-check-label" for="active">Active</label>
											</div>
											<div class="form-check form-radio form-check-inline">
												<input class="form-check-input" id="inactive" name="status" value="inactive" type="radio">
												<label class="form-check-label" for="inactive">Inactive</label>
											</div>
										</div>
									</div>
									<div class="m-t-20 text-center">
										<button type="button" id="publishBlog" class="btn btn-primary btn-lg">Publish Blog</button>
									</div>
								</form>
							</div>
						</div>
						<!-- /Add details -->

					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- /Page Wrapper -->
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('addBlogForm');
        var button = document.getElementById('publishBlog');
        var updateRoute = document.getElementById('storeRoute').value; // 使用更新路由
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // 获取 CSRF 令牌

        button.addEventListener('click', function() {
            var formData = new FormData(form);
            formData.append('_token', csrfToken); // 添加 CSRF 令牌到表单数据中
            formData.append('_method', 'PUT'); // 添加此行来伪装 PUT 请求

            fetch(updateRoute, {
                method: 'POST', // 虽然是 PUT 请求，但这里使用 POST
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // 确保 CSRF 令牌被包括在请求中
                    'Accept': 'application/json', // 期望返回的数据类型
                    'X-Requested-With': 'XMLHttpRequest' // 表示这是一个 AJAX 请求
                }
            })
            .then(response => {
                if (response.status === 422) {
                    // 服务器返回了验证错误的响应
                    return response.json().then((data) => {
                        throw new Error(`Validation failed: ${JSON.stringify(data)}`);
                    });
                }
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // 处理 JSON 数据
                alert('Update successful!'); // 弹出成功消息
                console.log(data);
            })
            .catch(error => {
                alert('Update failed: ' + error.message); // 弹出错误消息
                console.error('There has been a problem with your fetch operation:', error);
                // 这里您可以将错误信息显示给用户
            });
        });
    });
</script>
@endsection
