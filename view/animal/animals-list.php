<?php
// filepath: e:\laragon\www\animal_php\view\animal\animals-list.php
require_once '../../controller/AnimalController.php';

$animalController = new AnimalController();
$searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : '';
$animals = $animalController->getAllAnimals();

function normalizeString($str) {
    $str = mb_strtolower($str, 'UTF-8');
    $str = preg_replace('/[áàảãạâấầẩẫậăắằẳẵặ]/u', 'a', $str);
    $str = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $str);
    $str = preg_replace('/[íìỉĩị]/u', 'i', $str);
    $str = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $str);
    $str = preg_replace('/[úùủũụưứừửữự]/u', 'u', $str);
    $str = preg_replace('/[ýỳỷỹỵ]/u', 'y', $str);
    $str = preg_replace('/đ/u', 'd', $str);
    return $str;
}

if ($searchQuery !== '') {
    if ($searchQuery === 'Unknown') {
        $animals = [];
    } else {
        $normalizedSearchQuery = normalizeString($searchQuery);
        $exactMatches = array_filter($animals, function($animal) use ($searchQuery) {
            return mb_strtolower($animal['name'], 'UTF-8') === mb_strtolower($searchQuery, 'UTF-8');
        });
        if (!empty($exactMatches)) {
            $animals = $exactMatches;
        } else {
            $animals = array_filter($animals, function($animal) use ($normalizedSearchQuery) {
                return mb_stripos(normalizeString($animal['name']), $normalizedSearchQuery) !== false;
            });
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link rel="stylesheet" href="/animal_php/lib/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/animal_php/css/mystyle.css" asp-append-version="true"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .animal-name {
            margin-right: 10px; /* Space between name and progress bar */
            font-weight: bold; /* Make the name bold */
            animation: jump 0.5s infinite alternate; /* Jumping effect */
        }

        .progress-container {
            width: 100%; /* Full width */
            background-color: #ddd; /* Background color of the bar */
            border-radius: 5px; /* Rounded corners */
            position: relative; /* Position for absolute elements */
        }

        .progress-bar {
            height: 20px; /* Height of the bar */
            background-color: #4caf50; /* Color of the filled bar */
            border-radius: 5px; /* Rounded corners */
            position: relative; /* Position for absolute elements */
        }

        .progress-text {
            position: absolute; /* Position for absolute positioning */
            right: 10px; /* Align to the right */
            top: 0; /* Center vertically */
            line-height: 20px; /* Center text vertically */
            color: white; /* Text color */
        }

        @keyframes jump {
            0% { transform: translateY(0); }
            100% { transform: translateY(-5px); }
        }
    </style>
</head>
<body>
<?php
include '../header.php';
?>
<section layout:fragment="content" style="padding: 0;">
    <section class="ClassAnimal">
        <img src="/animal_php/view/design/ClassAnimal/Background/chim.gif" alt="Background vid" class="classbg"/>
        <h1 class="textclassanimalName" style="margin-top:-300px;margin-left:-1000px;">Động vật </h1>
        <h1 class="textclassanimalInfo" style="margin-left:300px;">Động vật là nhóm sinh vật trong tự nhiên bao gồm các
            hình thái sống đa dạng, chúng có thể được tìm thấy ở mọi môi trường sống trên Trái Đất, từ đại dương sâu tới
            rừng rậm, sa mạc khô cằn. Chúng đóng vai trò quan trọng trong hệ sinh thái, tham gia vào chu trình thực vật,
            giữ cân bằng hệ sinh thái.</h1>
        <div class="PostList" style="margin-top: 100px; display: flex; flex-wrap: wrap;">
            <div class="popup" style=" margin-left:800px;">
                <!-- Trigger/Open The Modal -->
                <a id="mbtn" class="button" style="margin-top:-80px">
                    <span class="content">Kiểm tra kết quả!</span>
                </a>
                <!-- The Modal -->
                <div id="modalDialog" class="modal">
                    <div class="modal-content animate-top"
                         style="background-image: url('/animal_php/view/design/Explore/bg.png');object-fit: cover;">
                        <div class="modal-header">
                            <b class="modal-title" style="color:white;">Kết quả tìm kiếm</b>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="predictionResults" style="text-align:justify;color:white;"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list" style="margin-top:-100px; display: flex; flex-wrap: wrap;">
            <?php if (empty($animals)) { ?>
                <h1 class="textclassanimalName" style="margin-top:100px;">Chúng tôi rất tiếc vì con vật bạn tìm kiếm
                    không có trong danh sách trên trang web.Nếu có thể,mong bạn hãy chia sẽ hình ảnh hoặc trải
                    nghiêm của mình về con vật mà bạn muốn tìm thông qua kênh Community!</h1>
                <a href="/animal_php/Posts" class="button" style="margin-top: 50px;">
                    <span class="content">Community!</span>
                </a>
            <?php } else { ?>
                <?php foreach ($animals as $animal) { ?>
                    <a href="/animal_php/view/animal/view_animal.php?id=<?php echo htmlspecialchars($animal['id_animal']); ?>"
                       style="margin-left: 160px;margin-top: 60px; text-decoration: none; border-radius:20px;">
                        <img src="/animal_php/images/<?php echo htmlspecialchars($animal['avatar']); ?>" alt="Avatar" class="itemAvatar"
                             style="border-radius:20px;"/>
                        <h1 class="textclassanimalInfo" style="text-align:center;"><?php echo htmlspecialchars($animal['name']); ?></h1>
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        /*
         * Modal popup
         */
        // Get the modal
        var modal = $('#modalDialog');

        // Get the button that opens the modal
        var btn = $("#mbtn");

        // Get the element that closes the modal
        var span = $(".close");

        $(document).ready(function () {
            // When the user clicks the button, open the modal
            btn.on('click', function () {
                displayPredictionsInModal();
                modal.show();
            });

            // When the user clicks on (x), close the modal
            span.on('click', function () {
                modal.hide();
            });
        });

        $('body').bind('click', function (e) {
            if ($(e.target).hasClass("modal")) {
                modal.hide();
            }
        });

        function displayPredictionsInModal() {
            const predictions = JSON.parse(localStorage.getItem('animalPredictions'));
            const predictionResultsElement = $('#predictionResults');

            if (predictions && predictions.length > 0) {
                let resultsHtml = '';
                predictions.forEach(prediction => {
                    const score = (prediction.score); // Assuming score is already a percentage
                    resultsHtml += `
                <div style="display: flex; align-items: center; margin-bottom: 10px;">
                     <div class="animal-name" style="margin-right: 10px;">${prediction.animal}:</div>
                    <div class="progress-container" style="flex-grow: 1;">
                        <div class="progress-bar" style="width: ${score}%;"></div>
                        <span class="progress-text" style="color: red">${score}%</span>
                    </div>
                </div>
            `;
                });
                predictionResultsElement.html(resultsHtml);
            } else {
                predictionResultsElement.html('No predictions available.');
            }
        }
    </script>
</section>
<?php
include '../footer.php';
?>
</body>

</html>