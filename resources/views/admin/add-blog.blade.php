@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Add Blog</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
						<li class="breadcrumb-item active">Add Blog</li>
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
								<input type="hidden" id="storeRoute" value="{{ route('admin.blog') }}">

								<div class="form-group">
										<label>Blog Name</label>
										<input class="form-control" type="text" name="name" >
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
										<textarea cols="30" rows="6" class="form-control" name="description"></textarea>

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
    var storeRoute = document.getElementById('storeRoute').value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // 获取 CSRF 令牌

    // 检查必填字段是否填写
    function checkRequiredFields() {
        var requiredFields = form.querySelectorAll('[name="name"], [name="image"], [name="category"], [name="sub_category"], [name="description"], [name="status"]:checked');
        var missingFields = [];
        requiredFields.forEach(function(field) {
            if ((field.type !== 'radio' && field.value.trim() === '') || (field.type === 'file' && field.files.length === 0)) {
                missingFields.push(field.name);
            }
        });
        return missingFields;
    }

    button.addEventListener('click', function() {
        var missingFields = checkRequiredFields();
        if (missingFields.length > 0) {
            alert('Please fill in the following fields: ' + missingFields.join(', '));
            return;
        }

        var formData = new FormData(form);
        formData.append('_token', csrfToken); // 添加 CSRF 令牌到表单数据中

        fetch(storeRoute, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken // 从 meta 标签获取的 CSRF 令牌
            }
        })
        .then(response => {
            if (response.status === 422) {
                // 如果状态码为 422，说明是验证错误
                return response.json().then(data => {
                    // 这里我们可以获取到具体的验证错误信息
                    throw data;
                });
            } else if (!response.ok) {
                // 如果是其他类型的错误，则抛出一个通用错误
                throw new Error('HTTP error, status = ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            alert('Blog published successfully.'); // 显示成功消息
            // 这里可以添加更多的代码来处理成功的响应，例如跳转到另一个页面
        })
        .catch(error => {
            if (error.errors) {
                // 如果错误中包含了 errors 属性，说明这是验证错误信息
                let errorMessage = "Please check the following fields:\n";
                for (let field in error.errors) {
                    errorMessage += `${field}: ${error.errors[field].join(", ")}\n`;
                }
                alert(errorMessage);
            } else {
                // 如果不是验证错误，则可能是其他类型的错误
                console.error('There has been a problem with your fetch operation:', error);
                alert('An error occurred. Please try again.');
            }
        });
    });
});
</script>
@endsection
