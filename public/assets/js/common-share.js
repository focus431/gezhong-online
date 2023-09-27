document.addEventListener("DOMContentLoaded", function () {
    // 共享的登出功能
    const logoutButtons = document.querySelectorAll("[data-logout-button]");
    logoutButtons.forEach(button => {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let formData = new FormData();
            formData.append("_token", token);
            fetch('/logout', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/index';
                }
            });
        });
    });

    // 檢查 'save-changes' 元素是否存在
    const saveChangesButton = document.getElementById("save-changes");
    if (saveChangesButton) {
        // 如果存在，則添加事件監聽器
        saveChangesButton.addEventListener("click", function (e) {
            e.preventDefault();
            let formData = new FormData(document.getElementById("profile-form"));
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append("_token", token);
            fetch('/profile-settings-mentee', {  // 或者是 '/profile-settings-mentor'，取決於您需要的 URL
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Profile updated successfully.");
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
            });
        });
    }
});
