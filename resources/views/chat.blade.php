<?php $page = "chat"; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Content -->
<div class="content">
	<div class="container-fluid">
		<div class="settings-back mb-3">
	<a href="dashboard_mentee">
				<i class="fas fa-long-arrow-alt-left"></i> <span>Back</span>
			</a>
		</div>
		<div class="row">
			<div class="col-sm-12 mb-4">
				<div class="chat-window" id="app">

					<!-- Chat Left -->
					<div class="chat-cont-left">
						<form class="chat-search d-flex align-items-center">
							<div class="avatar avatar-online me-3">
								<img src="assets/img/user/user.jpg" alt="User Image" class="avatar-img rounded-circle">
							</div>
							<div class="input-group">
								<div class="input-group-prepend">
									<i class="fas fa-search"></i>
								</div>
								<input type="text" class="form-control rounded-pill" placeholder="Search">
							</div>
						</form>
						<div class="chat-header">
							<span>Chats</span>
						</div>
						<div class="chat-users-list">
							<div class="chat-scroll">
								<!-- 这里放置聊天用户列表 -->
							</div>
						</div>
					</div>
					<!-- /Chat Left -->

					<!-- Chat Right -->
					<div class="chat-cont-right">
						<div class="chat-header">
							<a id="back_user_list" href="javascript:void(0)" class="back-user-list">
								<i class="material-icons">chevron_left</i>
							</a>
							<div class="media d-flex">
								<div class="media-img-wrap flex-shrink-0">
									<div class="avatar avatar-online">
										<img src="assets/img/user/user.jpg" alt="User Image" class="avatar-img rounded-circle">
									</div>
								</div>
								<div class="media-body flex-grow-1">
									<!-- 在这里显示用户名 -->
									<div class="user-name"></div>

								</div>
							</div>
							<div class="chat-options">
								<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#voice_call">
									<i class="material-icons">local_phone</i>
								</a>
								<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#video_call">
									<i class="material-icons">videocam</i>
								</a>
								<a href="javascript:void(0)">
									<i class="material-icons">more_vert</i>
								</a>
							</div>
						</div>
						<div class="chat-body">
							<div class="chat-scroll">
								<ul class="list-unstyled">
									<!-- 这里放置聊天消息 -->
									<li v-for="message in messages">
										<div v-text="message.content"></div>
									</li>
								</ul>
							</div>
						</div>
						<div class="chat-footer">
							<div class="input-group">
								<div class="btn-file btn">
									<i class="fa fa-paperclip"></i>
									<input type="file">
								</div>
								<input v-model="newMessage" type="text" class="input-msg-send form-control" placeholder="Type something">
								<button @click="sendMessage" type="button" class="btn msg-send-btn">Send</button>
							</div>
						</div>
					</div>
					<!-- /Chat Right -->

				</div>
			</div>
		</div>
		<!-- /Row -->

	</div>
</div>
<!-- /Page Content -->
@endsection


@section('scripts')
<!-- Include Vue.js and Axios before your custom scripts -->
<script src="https://cdn.jsdelivr.net/npm/vue@3.3.4/dist/vue.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Make sure these scripts are placed after Vue.js and Axios -->

<script defer>
	document.addEventListener("DOMContentLoaded", function() {
		console.log('DOM fully loaded');
		// Ensure Vue and Axios are loaded
		if (typeof Vue === 'undefined' || typeof axios === 'undefined') {
			console.error('Vue or Axios is not loaded');
			return;
		}

		const app = Vue.createApp({
			data() {
				return {
					newMessage: '',
					messages: [], // Store chat messages
					userName: '', // Store the user's name
				};
			},
			mounted() {
				console.log("Vue is mounted!");
				// Load the user's name
				this.getUserName();
				// Load chat messages after Vue instance is mounted
				this.getMessages();
			},
			methods: {
				sendMessage() {
					if (this.newMessage.trim() === '') return;

					// 要发送到后端的消息数据
					const messageData = {
						content: this.newMessage,
						// 其他可能需要的字段，例如：聊天室ID、发件人ID等
					};

					// 使用Axios发送POST请求到后端
					axios.post('/api/sendMessage', messageData) // 请根据您的API端点修改这里的URL
						.then(response => {
							// 如果成功，处理返回的数据
							this.messages.push({
								type: 'sent',
								content: this.newMessage,
								time: new Date().toLocaleTimeString(),
							});

							// 清空输入字段
							this.newMessage = '';
						})
						.catch(error => {
							// 如果出错，显示错误信息
							console.error('发送消息失败', error);
						});
				},
				getUserName() {

					// 发起请求以获取用户的名字，使用用户ID
					axios.get('/api/getUserName') // 请根据您的API端点修改这里的URL
						.then(response => {
							console.log(response);
							// 假设响应包含用户的名字
							this.first_name = response.data.first_name;
							this.last_name = response.data.last_name;
							console.log(`${this.first_name} ${this.last_name}`); // 使用模板字符串
						})
						.catch(error => {

							console.error('无法获取用户名', error);
						});


				},
				getMessages() {
					console.log('getMessages 方法被调用');
					// 以下是原有代码
					axios.get('/api/getMessages') // 根据您的API端点替换
						.then(response => {
							// 假设响应包含消息数组
							this.messages = response.data;
						})
						.catch(error => {
							console.error('无法获取消息', error);
						});
				},
			},
		});

		app.mount('#app');
	});
</script>
@endsection