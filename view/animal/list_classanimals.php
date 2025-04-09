<?php
require_once '../../controller/AnimalController.php';

$animalController = new AnimalController();
$viewData = $animalController->handleClassAnimalsList();
$classAnimals = $viewData['classAnimals'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Danh sách loài động vật</title>
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link rel="stylesheet" href="/animal_php/lib/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/animal_php/css/mystyle.css"/>
    <style>
        .class-card {
            border-radius: 15px;
            overflow: hidden;
            margin: 15px;
            transition: transform 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .class-card:hover {
            transform: translateY(-5px);
        }

        .class-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .class-info {
            padding: 15px;
            background: white;
        }

        .animals-container {
            display: none;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-top: 20px;
        }

        .animal-card {
            border-radius: 10px;
            margin: 10px;
            transition: transform 0.3s;
        }

        .animal-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<?php include '../header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách các loài động vật</h1>
    
    <div class="row">
        <?php foreach ($classAnimals as $class): ?>
            <div class="col-md-4">
                <div class="class-card" onclick="toggleAnimals(<?php echo $class['id_class']; ?>)">
                    <img src="/animal_php/images/<?php echo htmlspecialchars($class['image']); ?>" 
                         alt="<?php echo htmlspecialchars($class['name']); ?>" 
                         class="class-image">
                    <div class="class-info">
                        <h3><?php echo htmlspecialchars($class['name']); ?></h3>
                        <p><?php echo htmlspecialchars($class['description']); ?></p>
                    </div>
                </div>
                
                <div id="animals-<?php echo $class['id_class']; ?>" class="animals-container">
                    <h4>Động vật thuộc loài <?php echo htmlspecialchars($class['name']); ?></h4>
                    <div class="row" id="animals-list-<?php echo $class['id_class']; ?>">
                        <!-- Animals will be loaded here via AJAX -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function toggleAnimals(classId) {
    const containerId = `#animals-${classId}`;
    const container = $(containerId);
    const animalsList = $(`#animals-list-${classId}`);

    if (container.is(':hidden')) {
        // Load animals only if they haven't been loaded yet
        if (animalsList.children().length === 0) {
            $.ajax({
                url: '/animal_php/api/get_animals_by_class.php',
                method: 'GET',
                data: { classId: classId },
                success: function(response) {
                    const animals = JSON.parse(response);
                    let html = '';
                    
                    animals.forEach(animal => {
                        html += `
                            <div class="col-md-6 mb-3">
                                <a href="/animal_php/view/animal/view_animal.php?id=${animal.id_animal}" 
                                   class="text-decoration-none">
                                    <div class="animal-card">
                                        <img src="/animal_php/images/${animal.avatar}" 
                                             alt="${animal.name}" 
                                             class="img-fluid rounded">
                                        <h5 class="text-center mt-2">${animal.name}</h5>
                                    </div>
                                </a>
                            </div>
                        `;
                    });
                    
                    animalsList.html(html);
                }
            });
        }
        container.slideDown();
    } else {
        container.slideUp();
    }
}
</script>

<?php include '../footer.php'; ?>
</body>
</html> 