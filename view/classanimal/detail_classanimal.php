<?php
// filepath: e:\laragon\www\animal_php\view\classanimal\detail_classanimal.php
require_once __DIR__ . '/../../controller/ClassAnimalController.php';

// Get the class animal ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$classAnimalController = new ClassAnimalController();
$classanimal = $classAnimalController->getClassAnimalById($id);

// Fetch animals related to this class animal
$animals = $classAnimalController->getAnimalsByClassAnimalId($id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title th:text="${title} ?: 'ClassAnimal Detail'"> ClassAnimals List </title>
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link rel="stylesheet" href="/animal_php/css/mystyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
        <img src="/animal_php/view/design/ClassAnimal/Background/<?php echo htmlspecialchars($classanimal['background_video']); ?>" alt="Background vid" class="classbg" />
        <h1 class="textclassanimalName" style="margin-top:-300px;margin-left: 200px;"><?php echo htmlspecialchars($classanimal['name']); ?></h1>
        <h1 class="textclassanimalInfo" style="margin-left:300px;"><?php echo htmlspecialchars($classanimal['info']); ?></h1>
        <div class="list" style="margin-top: 150px; display: flex; flex-wrap: wrap;">
            <?php foreach ($animals as $animal) { ?>
                <div>
                    <a href="/animal_php/animal/detail/<?php echo htmlspecialchars($animal['id_animal']); ?>" style="margin-left: 160px;margin-top: 60px; text-decoration: none; border-radius:20px;">
                        <img src="/animal_php/images/<?php echo htmlspecialchars($animal['avatar']); ?>" alt="Avatar" class="itemAvatar" style="border-radius:20px;" />
                        <h1 class="textclassanimalInfo" style="text-align:center; margin-left: 150px;"><?php echo htmlspecialchars($animal['name']); ?></h1>
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>
</section>


        </div>
    </section>
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
                        element: document.querySelector('.textclassanimalName'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                    Đây là tên nhóm động vật.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.textclassanimalInfo'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Đặc điểm về nhóm động vật này.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.itemAvatar'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Đây là động vật thuộc lớp đó.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    // Add more steps as needed...
                ],
                tooltipPosition: 'bottom', // Default position for tooltips
                positionPrecedence: ['bottom', 'top', 'left', 'right'] // Order of positioning
            }).start();
        };
    </script>
    <script type="text/javascript">
        if (localStorage.getItem('introCompleted') === 'true') {
            introJs().setOptions({
                steps: [
                    {
                        element: document.querySelector('.textclassanimalName'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                    Đây là tên nhóm động vật.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.textclassanimalInfo'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Đặc điểm về nhóm động vật này.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.itemAvatar'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Đây là động vật thuộc lớp đó.
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.itemAvatar'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Ta hãy xem thử bên trong động vật có thông tin gì nhé!
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    {
                        element: document.querySelector('.list'),
                        intro: `
                                 <p style="color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;  font-size: 30px;" >
                                   Tay hãy xem thử bên trong động vật có thông tin gì nhé!
                                </p>
                `,
                        position: 'bottom' // Position tooltip directly below the text
                    },
                    // Add more steps as needed...
                ],
                tooltipPosition: 'bottom', // Default position for tooltips
                positionPrecedence: ['bottom', 'top', 'left', 'right'],
                // Order of positioning
            }).onchange(function (targetElement) {
                // Check if the current step is the last step
                if (targetElement === document.querySelector('.list')) {
                    localStorage.removeItem('introCompleted');
                    localStorage.setItem('introAnimal', 'true');
                    window.location.href = 'http://localhost/animal_php/animal/detail/1';
                }
            }).start();
        };
    </script>
</section>
<?php
include '../footer.php';
?>
</body>
</html>