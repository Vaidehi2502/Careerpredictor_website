<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    
    $predictedCareers = [];
    if (isset($_POST["skills"])) {
        $skills = strtolower($_POST["skills"]);
    } else {
        $skills = "unknown";
    }

    if (strpos($skills, "python") !== false || strpos($skills, "java") !== false) {
        $predictedCareers = ["Software Developer", "Backend Engineer"];
    } elseif (strpos($skills, "design") !== false) {
        $predictedCareers = ["UI/UX Designer", "Graphic Designer"];
    } else {
        $predictedCareers = ["General Career Advisor", "Consultant"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Career Prediction Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<section id="prediction-result">
    <h1>🎯 Career Prediction</h1>

    <p>Based on your skills, here are some career suggestions:</p>

    <ul>
        <?php foreach ($predictedCareers as $career) : ?>
            <li><?= htmlspecialchars($career) ?></li>
        <?php endforeach; ?>
    </ul>

    <br>
    <form action="index.html" method="get">
        <button type="submit" class="btn">Back to Home</button>
    </form>
</section>

</body>
</html>
