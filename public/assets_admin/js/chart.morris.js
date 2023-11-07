// 假設這是從後端接收到的數據
var monthlyCounts = {
	'1': 10,
	'2': 15,
	'3': 20,
	// 確保這個對象包含了 1 到 12 月的數據
};

// 生成一個數據數組，如果某個月份沒有數據，則學員數為 0
var chartData = [];
for (var month = 1; month <= 12; month++) {
	chartData.push({
			y: `${month < 10 ? '0' + month : month}-01`, // 格式為 'MM-DD'
			a: monthlyCounts[month] || 0 // 如果沒有該月的數據，則為 0
	});
}

// 使用生成的 chartData 來初始化圖表
Morris.Area({
	element: 'morrisArea',
	data: chartData,
	xkey: 'y',
	ykeys: ['a'],
	labels: ['Students'],
	lineColors: ['#1b5a90'],
	lineWidth: 2,
	fillOpacity: 0.5,
	gridTextSize: 10,
	hideHover: 'auto',
	resize: true,
	xLabelFormat: function(x) {
			return x.src.y.substring(0, 2); // 只顯示月份
	},
	yLabelFormat: function(y) {
			return y.toString() + ' students'; // 添加 'students' 文字
	},
	parseTime: false // 關閉時間解析，因為我們使用的是自定義格式
});
