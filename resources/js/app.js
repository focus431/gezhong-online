import './bootstrap';
import { createApp } from 'vue';
import ChatRoom from './components/ChatRoom.vue';

const app = createApp({
    components: {
        ChatRoom,
    },
});
app.component('chat-room', ChatRoom);
// app.mount('#app');


