<template>
  <div>
    <div v-for="message in messages" :key="message.id">
      {{ message.content }}
    </div>
    <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type a message">
  </div>
</template>

<script>
// 如果您没有专门的API模块，您可以直接导入axios
import axios from 'axios';

export default {
  data() {
    return {
      first_name: '', // 确保变量名正确
    last_name: '',  // 确保变量名正确
      messages: [],
      newMessage: '',
    };
  },
  methods: {
  fetchMessages() {
    axios.get('/api/getMessages')
      .then(response => {
        this.messages = response.data;
      })
      .catch(error => {
        console.error('Error fetching messages:', error);
        // 可以设置一个标志或者通知用户
      });
  },
  sendMessage() {
    if (this.newMessage.trim() === '') return;
    
    // 創建一個表示新消息的對象
    const messageData = {
        type: 'sent', // 或者 'received'，根據消息的發送者來設置
        content: this.newMessage,
        time: new Date().toLocaleTimeString(),
    };

    // 將新消息添加到消息列表中
    this.messages.push(messageData);

    // 清空輸入框
    this.newMessage = '';

    // 在這裡，你可以向後端發送消息，並在成功發送後處理任何必要的邏輯

    // 假設你使用axios向後端發送消息
    axios.post('/api/sendMessage', messageData) // 請根據你的API端點進行調整
        .then(response => {
            // 在成功發送後執行任何後續邏輯
            console.log('Message sent successfully', response.data);
        })
        .catch(error => {
            console.error('Unable to send message', error);
            // 在發送失敗時執行相應的錯誤處理邏輯
        });
},

},

};
</script>
