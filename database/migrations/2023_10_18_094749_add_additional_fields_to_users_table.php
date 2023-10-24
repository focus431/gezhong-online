<?php $page = "profile"; ?>
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
                        <li class="breadcrumb-item active" aria-current="page">Mentor Profile</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Mentor Profile</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">

                <!-- Mentor Widget -->
                <div class="card">
                    <div class="card-body">
                        <div class="mentor-widget">
                            <!-- ... (Your existing content remains unchanged) ... -->
                        </div>
                    </div>
                </div>
                <!-- /Mentor Widget -->

                <!-- Mentor Details Tab -->
                <div class="card">
                    <div class="card-body custom-border-card pb-0">

                        <!-- About Details -->
                        <div class="widget about-widget custom-about mb-0">
                            <h4 class="widget-title">About Me</h4>
                            <hr />
                            <p>
                                Enthusiastic and experienced online English teacher specialized in using interactive and innovative teaching methods to boost students' language skills. Possessing years of teaching experiences that include one-on-one lessons and group sessions.
                            </p>
                            <!-- ... (Your existing content remains unchanged) ... -->
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body custom-border-card pb-0">
                        <!-- Teaching Experience -->
                        <div class="widget experience-widget mb-0">
                            <h4 class="widget-title">Teaching Experience</h4>
                            <hr />
                            <div class="experience-box">
                                <ul class="experience-list profile-custom-list">
                                    <li>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <span>Online English Teacher</span>
                                                <div class="row-result">Company or Platform</div>
                                                <div class="row-result">Years of Experience</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Teaching Experience -->

                        <!-- Qualifications and Skills -->
                        <div class="widget qualification-widget mb-0">
                            <h4 class="widget-title">Qualifications and Skills</h4>
                            <hr />
                            <div class="qualification-box">
                                <ul class="qualification-list profile-custom-list">
                                    <li>
                                        <div class="qualification-content">
                                            <div class="timeline-content">
                                                <span>Bachelor's degree in English Literature</span>
                                                <div class="row-result">University</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="qualification-content">
                                            <div class="timeline-content">
                                                <span>TEFL Certification</span>
                                                <div class="row-result">Institute</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Qualifications and Skills -->
                    </div>
                </div>

                <div class="card">
                    <div class="card-body pb-1 custom-border-card" id="youtubeContainer">
                        <!-- YouTube 影片將在這裡 -->
                    </div>
                </div>

                <!-- /Mentor Details Tab -->

            </div>
        </div>
    </div>
    <!-- /Page Content -->
</div>

@endsection
@section('scripts')
    <script>
        // 假設從後端獲取的 YouTube URL 存儲在變數中
        var youtubeLink = "{{ $schedule->youtube_link }}"; // Laravel blade 語法
        var video_id = new URLSearchParams(new URL(youtubeLink).search).get("v");

        if (video_id) {
            var iframe = document.createElement('iframe');
            iframe.width = "100%";
            iframe.height = "500";
            iframe.src = "https://www.youtube.com/embed/" + video_id;
            iframe.frameBorder = "0";
            iframe.allowFullscreen = true;

            document.getElementById('youtubeContainer').appendChild(iframe);
        }


        // JavaScript部分
        // 假設您已經有了一個對應國家名稱到國旗圖示的映射
        const countryToFlag = {
            'USA': '🇺🇸',
            'Taiwan': '🇹🇼',
            '台灣': '🇹🇼',
            'Philippines': '🇵🇭',
            '菲律賓': '🇵🇭',
            // ... 其他國家
        };


        // 假設 $schedule->country 的值會被儲存到一個變數中，例如：
        const countryNameFromSchedule = 'Taiwan'; // 這個應該來自 $schedule->country

        // 找到HTML元素並更改它的內容
        const countryNameElement = document.getElementById('country-name');
        countryNameElement.textContent = countryToFlag[countryNameFromSchedule] || countryNameFromSchedule;
    </script>
    @endsection
