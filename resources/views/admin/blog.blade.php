@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">
<!-- Session Message -->
@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		@endif

		@if (session('error'))
			<div class="alert alert-danger">
				{{ session('error') }}
			</div>
		@endif
		<!-- /Session Message -->
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Blog</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
						<li class="breadcrumb-item active">Blog</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="row">
			@foreach ($blogs as $blog)
			<div class="col-12 col-md-6 col-xl-4">
				<div class="course-box blog grid-blog">
					<div class="blog-image mb-0">
						<img class="img-fluid" src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"></a>
					</div>
					<div class="course-content">
						<span class="date">{{ $blog->created_at->format('M d Y') }}</span>
						<span class="course-title">{{ $blog->name }}</span>
						<p>{{ Str::limit($blog->description, 100) }}</p>
						<div class="row">
							<div class="col">
								<a href="{{ route('admin.edit-blog', $blog->id) }}" class="text-success">
									<i class="fa fa-edit"></i> Edit
								</a>
							</div>
							<div class="col text-end">
    <a href="javascript:void(0);" class="text-danger delete-blog-button" data-blog-id="{{ $blog->id }}">
        <i class="fa fa-trash-o"></i> Delete
    </a>
    <form id="delete-blog-form-{{ $blog->id }}" action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>

						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
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
// 确保在文档准备好后绑定事件
document.addEventListener('DOMContentLoaded', function() {
    // 为所有删除按钮绑定事件
    const deleteButtons = document.querySelectorAll('.delete-blog-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // 阻止链接默认行为
            const blogId = this.dataset.blogId; // 从数据属性中获取博客ID
            const deleteForm = document.getElementById('delete-blog-form-' + blogId);
						const confirmDelete = confirm('{{ trans("Are you sure you want to delete this blog?") }}');
            if (confirmDelete) {
                deleteForm.submit(); // 如果用户确认删除，则提交表单
            }
        });
    });
});
</script>
@endsection
