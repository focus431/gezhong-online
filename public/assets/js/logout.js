// 定義閒置時間變量，單位是毫秒
const idleTimeToAsk = 5 * 60 * 1000; // 5分鐘
const idleTimeToLogout = 6 * 60 * 1000; // 6分鐘

// 初始化計時器
let askTimer;
let logoutTimer;

// 初始化登錄狀態
let isLoggedIn = true;

// 定義需要啟用計時器功能的頁面
const pagesToInclude = [
  'profile-settings-mentor',
  'profile-settings-mentee'
];

// 網頁加載完成後啟動計時器
window.addEventListener('load', function() {
  if (pagesToInclude.some(page => window.location.pathname.includes(page))) {
    startTimers();
  }
});

// 監聽鍵盤和鼠標事件
document.addEventListener('keydown', resetTimers);
document.addEventListener('mousemove', resetTimers);

// 重置計時器的函數
function resetTimers() {
  if (isLoggedIn && pagesToInclude.some(page => window.location.pathname.includes(page))) {
    console.log("Activity detected, resetting timers.");
    clearTimeout(askTimer);
    clearTimeout(logoutTimer);
    startTimers();
  }
}

// 開始計時器的函數
function startTimers() {
  if (isLoggedIn && pagesToInclude.some(page => window.location.pathname.includes(page))) {
    askTimer = setTimeout(askToStayConnected, idleTimeToAsk);
    logoutTimer = setTimeout(logout, idleTimeToLogout);
  }
}

// 問是否保持連線
function askToStayConnected() {
  const keepConnected = window.confirm("您已經5分鐘沒有活動，是否要保持連線？");
  if (keepConnected) {
    resetTimers();
  }
}

// 登出函數
async function logout() {
  if (isLoggedIn) {
    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const response = await fetch('/logout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ logout: true })
      });

      if (!response.ok) {
        throw new Error(`HTTP error: ${response.status}`);
      }

    } catch (error) {
      console.error('登出失敗:', error);
    } finally {
      isLoggedIn = false;
      clearTimeout(askTimer);
      clearTimeout(logoutTimer);
      window.location.href = '/home';
    }
  }
}

// 登錄成功後停止計時器的函數
function stopTimersOnLogin() {
  isLoggedIn = true;
  if (pagesToInclude.some(page => window.location.pathname.includes(page))) {
    clearTimeout(askTimer);
    clearTimeout(logoutTimer);
  }
}
