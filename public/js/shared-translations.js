let translations = {};

// 獲取當前用戶的語言設置，例如 'en' 或 'zh_TW'
const userLanguage = (navigator.language || navigator.userLanguage).replace('-', '_');


// 從後端獲取翻譯
fetch(`/translations?lang=${userLanguage}`)
    .then(response => response.json())
    .then(data => {
        translations = data;
        // console.log(translations); 
    })
    .catch(error => console.error('Error fetching translations:', error));

// 使用翻譯
function translate(key) {
    return translations[key] || key;
}

// 如果你想在其他地方使用這個函數，你可以將它添加到 window 對象
window.translate = translate;
