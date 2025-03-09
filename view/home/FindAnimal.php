<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link rel="stylesheet" href="/animal_php/css/mystyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/introjs.min.css">
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
            width: 60px; /* Set the desired width for the image */
            height: auto; /* Maintain aspect ratio */
        }

        .click-me {
            color: white; /* Text color */
            font-size: 14px; /* Font size for "Click Me" */
            margin-top: 5px; /* Space between image and text */
        }
    </style>
</head>
<body>
<?php
include '../header.php';
?>
<section layout:fragment="content" style="padding: 0;">
<section class="ClassAnimal">
    <img src="/animal_php/view/design/ClassAnimal/Background/chim.gif" alt="Background vid" class="classbg" />
    <h1 class="textclassanimalName" style="margin-top:-300px;margin-left: 200px;">Động vật </h1>
    <h1 class="textclassanimalInfo" style="margin-left:300px;">Động vật là nhóm sinh vật trong tự nhiên bao gồm các hình thái sống đa dạng, chúng có thể được tìm thấy ở mọi môi trường sống trên Trái Đất, từ đại dương sâu tới rừng rậm, sa mạc khô cằn. Chúng đóng vai trò quan trọng trong hệ sinh thái, tham gia vào chu trình thực vật, giữ cân bằng hệ sinh thái.</h1>
    <h1 class="textclassanimalInfo" style="margin-left:600px;margin-top:150px"> Vui lòng tải hình động vật mà bạn muốn tìm</h1>

    <input type="file" id="image-upload" class="fileup" accept="image/*" style="height:30px; width:500px;">

    <div id="image-container" style="margin-top:30px;border-radius:20px;" ></div>
    <div id="label-container"></div>
    <button type="button" onclick="predict()" style="margin-top:30px;" class="btn btn-primary">Tìm Kiếm</button>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
    <script type="text/javascript">
        const URL = "/animal_php/AnimalPredict/";

        let model, imageContainer, labelContainer, maxPredictions;

        async function start() {
            const modelURL = URL + "model.json";
            const metadataURL = URL + "metadata.json";

            model = await tmImage.load(modelURL, metadataURL);
            maxPredictions = model.getTotalClasses();

            const imageUpload = document.getElementById("image-upload");
            imageUpload.addEventListener("change", onImageUpload);

            imageContainer = document.getElementById("image-container");
            labelContainer = document.getElementById("label-container");
        }

        function onImageUpload(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                const image = document.createElement("img");
                image.src = e.target.result;
                imageContainer.innerHTML = "";
                imageContainer.appendChild(image);
            };
            reader.readAsDataURL(file);
        }

        async function predict() {
            const image = document.querySelector("#image-container img");
            if (!image) {
                alert("Vui lòng tải hình ảnh");
                return;
            }

            const predictions = await model.predict(image);
            const topPredictions = getTopPredictions(predictions, 5);

            let searchTerm = '';
            if (topPredictions[0].probability >= 0.8) {
                searchTerm = topPredictions[0].className;
            } else {
                searchTerm = "Unknown";
            }

            $('#searchTerm').val(searchTerm);
            $('#searchForm').unbind('submit').submit();

            // Save top predictions to local storage with keys "animal" and "score"
            const formattedPredictions = topPredictions.map(pred => ({
                animal: pred.className,
                score: (pred.probability * 100).toFixed(2) // Convert to percentage
            }));

            localStorage.setItem('animalPredictions', JSON.stringify(formattedPredictions));
        }

        function getTopPredictions(predictions, topN) {
            // Sort predictions by probability in descending order
            predictions.sort((a, b) => b.probability - a.probability);
            return predictions.slice(0, topN); // Get top N predictions
        }

        start();
    </script>
    <script src="~/js/script.js"></script>
    <div class="static-button" id="startIntro" style="margin-right: -100px">
        <img src="/animal_php/images/idle.gif" alt="Start Intro"
             style="max-width: 100%; max-height: 250px; height: auto; width: auto;">
        <div class="click-me"
             style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;">
            Bạn cần trợ giúp ?
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        // Your existing JavaScript code

        // Trigger Intro.js when the image is clicked
        document.getElementById('startIntro').onclick = function () {
            introJs().setOptions({
                steps: [
                    {
                        element: document.querySelector('#someElement0'),
                        intro: `
                        <div style="display: flex; align-items: center; text-align: left;">
                            <div style="flex: 1; padding: 10px;height: auto;min-width: 500px;margin-left: -200px" >
                                <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                    Đây là chức năng tìm kiếm động vật bằng hình ảnh.
                                </p>
                            </div>
                            <div style="flex: 1;">
                            <img src="/images/test.png" alt="Description of Image" style="height: 500px; width: 500px; object-fit: cover;margin-left: -180px" >
                            </div>
                        </div>
                    `
                    },
                    {
                        element: document.querySelector('.fileup'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                    Tải ảnh con vật bạn muốn tìm kiếm
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.fileup'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                    Chờ cho đế khi hình ảnh hiển thị
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.button'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                    Sau đó bấm tìm kiếm.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.button'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                    Hệ thống sẽ quét ảnh và tìm con vật bạn cần.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },

                ],
                tooltipPosition: 'bottom', // Default position for tooltips
                positionPrecedence: ['bottom', 'top', 'left', 'right'] // Order of positioning
            }).start();
        };
    </script>
</section>
</section>
<?php
include '../footer.php';
?>
</body>
</html>