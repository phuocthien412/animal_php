<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>NEKOPARA</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/animal_php/view/design/Home/logo.png" />    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/animal_php/css/mystyle.css" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .introjs-tooltip {
            background-color: transparent !important; /* Semi-transparent background */
            border: none !important; /* Remove border */
            box-shadow: none !important; /* Remove shadow */
            padding: 5px; /* Minimal padding to keep it close */
            width: max-content;
            height: max-content;
        }


        /* Styles for the static image button */
        .static-button {
            position: fixed; /* Fixes the button in the viewport */
            bottom: 20px; /* Distance from the bottom */
            right: 20px; /* Change left to right for bottom right positioning */
            cursor: pointer; /* Pointer cursor on hover */
            z-index: 1000; /* Ensure it appears above other elements */
            text-align: center; /* Center-align the text below the image */
        }

        .static-button img {
            width: 120px; /* Set the desired width for the image */
            height: 120px; /* Set the desired height for the image */
            border-radius: 50%; /* Make the image circular */
            box-shadow: 0 2px 10px rgba(0,0,0,0.2); /* Add a subtle shadow */
        }

        .click-me {
            color: white; /* Text color */
            font-size: 30px; /* Font size for "Click Me" */
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5); /* Add a subtle text shadow */
        }
    </style>
</head>

<body>
<?php
// filepath: /e:/laragon/www/animal_php/view/home/index.php

// Include the header part of the layout
include '../header.php';
?>
<section layout:fragment="content" style="padding: 0;">

    <nav class="sticky-top" style="margin-top: -20px;">
        <ul>
            <li><a href="#" class="home-marker active">Home</a></li>
            <li><a href="#about" class="about-marker">About</a></li>
            <li><a href="#explore" class="explore-marker">Explore</a></li>
            <li><a href="#support" class="support-marker">Support</a></li>
        </ul>
    </nav>

    <section id="home" class="home" style="margin-top: -100px;">
        <img src="/animal_php/view/design/Home/logo.png" class="logo1"/>
        <h1 class="texthome"> Chào mừng bạn đến với cổng thông tin về các loài động vật của NEKOPARA! </h1>
    </section>

    <section id="about" class="about">
        <div class="row ">
            <div class="col-md-6">
                <img src="/animal_php/view/design/About/logo.png" alt="Image 1" style="margin-top: -100px;">
            </div>
            <div class="col-md-6 test1">
                <h1 class="textabout" style="margin-left: -50px;">
                    Tại đây, chúng tôi cung cấp một nguồn tài nguyên phong phú và đa dạng về các loài động vật . Với đội
                    ngũ chuyên gia động vật và nhà nghiên cứu, chúng tôi đã tổng hợp thông tin chi tiết và thú vị về các
                    loại động vật từ những con cá nhỏ bé đến các loài thú hoang dã to lớn.
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 test2">
                <h1 class="textabout">
                    Qua trang NEKOPARA, chúng tôi muốn chia sẻ kiến thức và thông tin đáng tin cậy về
                    động vật, giúp mọi người hiểu rõ hơn về cuộc sống và sự đa dạng của chúng. Chúng tôi hy vọng rằng
                    thông qua việc tăng cường nhận thức và kiến thức về động vật, chúng ta có thể thúc đẩy những nỗ lực
                    bảo vệ môi trường và duy trì sự cân bằng tự nhiên.
                </h1>
            </div>
            <div class="col-md-6">
                <iframe width="650" height="400 " src="https://www.youtube.com/embed/5kozt0uDa4c">
                </iframe>
            </div>
        </div>
    </section>

    <section id="explore" class="explore">
        <div class="row" style="margin-top:-450px;margin-left:50px;">
            <div class="col-md-3">
                <h1 class="textexplore" style="margin-top:100px">Khám phá các nhóm động vật cùng NEKOPARA</h1>
            </div>
            <div class="col-md-3">
                <div class="container">
                    <a href="/classanimals/detail/1" class="card">
                        <div class="front" style="background-image: url('/animal_php/view/design/Explore/bosat.png');"></div>
                        <div class="back" style="background-image: url('/animal_php/view/design/Explore/bosat.png');">
                            <h1 class="textexplore">Động vật bò sát</h1>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container" style="margin-left:-50px;">
                    <a href="/classanimals/detail/2" class="card">
                        <div class="front" style="background-image: url('/animal_php/view/design/Explore/ca.png');"></div>
                        <div class="back" style="background-image: url('/animal_php/view/design/Explore/ca.png');">
                            <h1 class="textexplore">Cá</h1>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container" style="margin-left:-200px;">
                    <a href="/classanimals/detail/3" class="card">
                        <div class="front" style="background-image: url('/animal_php/view/design/Explore/chim.png');"></div>
                        <div class="back" style="background-image: url('/animal_php/view/design/Explore/chim.png');">
                            <h1 class="textexplore">Chim</h1>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:60px;">
            <div class="col-md-3">
                <div class="container">
                    <a href="/classanimals/detail/4" class="card">
                        <div class="front" style="background-image: url('/animal_php/view/design/Explore/dongvatcovu.png');"></div>
                        <div class="back" style="background-image: url('/animal_php/view/design/Explore/dongvatcovu.png');">
                            <h1 class="textexplore">Động vật có vú</h1>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container" style="margin-left:-50px;">
                    <a href="/classanimals/detail/5" class="card">
                        <div class="front" style="background-image: url('/animal_php/view/design/Explore/khongxuongsong.png');"></div>
                        <div class="back" style="background-image: url('/animal_php/view/design/Explore/khongxuongsong.png');">
                            <h1 class="textexplore">Động vật không xương sống</h1>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container" style="margin-left:-200px;">
                    <a href="/classanimals/detail/6" class="card">
                        <div class="front" style="background-image: url('/animal_php/view/design/Explore/luongcu.png');"></div>
                        <div class="back" style="background-image: url('/animal_php/view/design/Explore/luongcu.png');">

                            <h1 class="textexplore">Động vật lưỡng cư</h1>

                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <img src="/animal_php/view/design/About/logo.png" alt="Image 1" style="margin-left: -400px;">
            </div>
        </div>
    </section>

    <section id="support" class="support">
        <div class="row">
            <div class="col-md-6">
                <h1 class="textsupport" style="margin-top: -400px;">
                    Chúng tôi tìm kiếm sự hỗ trợ và đóng góp của
                    cộng
                    đồng để giúp phát triển và mở rộng trang web thông tin về động vật. Việc thu thập và cập nhật
                    nội
                    dung của các loài vật đòi hỏi một lượng lớn thông tin khổng lồ.
                </h1>
            </div>
            <div class="col-md-6">
                <h1 class="textsupport">
                    Bạn có thể đóng góp bằng cách chia sẻ những hình ảnh, những trải nghiệm về
                    động
                    vật mà bạn đã từng gặp thông qua phần diễn đàn trao đổi của chúng tôi.
                </h1>
                <a href="/posts" class="button" style="margin-top: 50px;">
                    <span class="content">Community!</span>
                </a>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">

        (function () {

            var navLinks = $('nav ul li a'),
                navH = $('nav').height(),
                section = $('section'),
                documentEl = $(document);

            documentEl.on('scroll', function () {
                var currentScrollPos = documentEl.scrollTop();

                section.each(function () {
                    var self = $(this);
                    if (self.offset().top < (currentScrollPos + navH) && (currentScrollPos + navH) < (self.offset().top + self.outerHeight())) {
                        var targetClass = '.' + self.attr('class') + '-marker';
                        navLinks.removeClass('active');
                        $(targetClass).addClass('active');
                    }
                });
            });
        })();
    </script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
    <div class="static-button" id="startIntro" style="margin-right: -100px">
        <img src="/animal_php/images/idle.gif" alt="Start Intro"
             style="max-width: 100%; max-height: 250px; height: auto; width: auto;">
        <div class="click-me"
             style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;">
            Bạn cần trợ giúp ?
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        // Your existing JavaScript code

        // Trigger Intro.js when the image is clicked
        document.getElementById('startIntro').onclick = function () {
            introJs().setOptions({
                steps: [
                    {
                        element: document.querySelector('.logo1'),
                        intro: `
                        <div style="display: flex; align-items: center; text-align: left;">
                            <div style="flex: 1; padding: 10px;height: auto;min-width: 500px;margin-left: -200px" >
                                <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                    Xin chào mình là Lily trợ lý của NEKOPARA.
                                </p>
                            </div>
                            <div style="flex: 1;">
                            <img src="/animal_php/view/images/trailer1.gif" alt="Description of Image" style="height: 500px; width: 500px; object-fit: cover;margin-left: -180px" >
                            </div>
                        </div>
                    `
                    },
                    {
                        element: document.querySelector('.test1'),
                        intro: `
                        <div style="display: flex; align-items: center; text-align: left;">
                            <div style="flex: 1; padding: 10px;height: auto;min-width: 500px;margin-left: -200px" >
                                <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Hôm nay mình sẽ dẫn bạn đi tham quan một vòng trang web của tụi mình nhé!
                                </p>
                            </div>
                            <div style="flex: 1;">
                            <img src="/animal_php/view/images/trailer2.png" alt="Description of Image" style="height: 500px; width: 500px; object-fit: cover;margin-left: -180px" >
                            </div>
                        </div>
                    `
                    },
                    {
                        element: document.querySelector('.logo1'),
                        intro: `
                                <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Logo của bọn mình nè.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the logo
                    },
                    {
                        element: document.querySelector('.test1'),
                        intro: `
                                <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Thông tin về NEKOPARA.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.test2'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Thông tin về NEKOPARA.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.card'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Đây là các nhóm động vật.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.card'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Khi nhấn vào sẽ hiện ra các loài động vật thuộc nhóm đó.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.button'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                    Bạn có thể xem tin tức ở đây.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.card'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Ta hãy xem thử bên trong nhóm động vật thì có gì nhé.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.front'),
                        intro: `
                `,
                        position: 'bottom'
                    }
                ],
                tooltipPosition: 'bottom',
                positionPrecedence: ['bottom', 'top', 'left', 'right'],
                // Order of positioning
            }).onchange(function (targetElement) {
                // Check if the current step is the last step
                if (targetElement === document.querySelector('.front')) {
                    localStorage.setItem('introCompleted', 'true');
                    window.location.href = '';
                }
            }).start();
        };
    </script>
</section>
<?php
// filepath: /e:/laragon/www/animal_php/view/home/index.php

// Include the header part of the layout
include '../footer.php';
?>
</body>
</html>
