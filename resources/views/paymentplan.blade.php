<?php $page = "blank-page"; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-12 col-12">
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">購買方案</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">購買方案</h2>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- 第一個主要Column：月繳方案 -->
			<div class="col-2">
				<div class="card fixed-card title">
					<div class="card-body">
						<h5 class="card-title">月繳方案</h5>
						<p class="card-text">30天自動扣款</p>
					</div>
				</div>
			</div>
			<!-- 第二個主要Column：其他四個方案 -->
			<div class="col-10">
				<div class="row">
					<!-- 各個方案 -->
					<!-- 各個方案 -->
					@foreach($plans as $plan)
					<div class="col-3">
						<!-- 在這裡，我將 card 的 id 設為 "card_{{ $plan->id }}" -->
					<div class="card fixed-card" data-id="{{ $plan->id }}">
							<div class="card-body">
								<p class="card-text">{{ $plan->price }}元</p>
								<p class="card-text">{{ $plan->lessons }}堂課/月</p>
								<button class="btn btn-primary register-btn">註冊會員</button>

							</div>
						</div>
					</div>
					@endforeach

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Page Content -->
@endsection
@section('scripts')
<script>
	
    window.isLoggedIn = @json($isLoggedIn);
    window.isMentee = @json($isMentee);
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const registerButtons = document.querySelectorAll('.register-btn');

        registerButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const cardElement = button.closest('.card');
                const cardId = cardElement.getAttribute('data-id');

                if (window.isLoggedIn) {
                    if (window.isMentee) {
                        // 已登入且角色為 'mentee'，轉到 checkout 頁面
                        window.location.href = `/checkout?card_id=${cardId}`;
                    } else {
                        // 已登入但角色不是 'mentee'，彈出提示訊息
                        alert('您不是 mentee，無法註冊！');
                    }
                } else {
                    // 未登入，轉到登入頁面
                    window.location.href = `/login?redirect_to=/checkout?card_id=${cardId}`;
                }
            });
        });
    });
</script>
@endsection
