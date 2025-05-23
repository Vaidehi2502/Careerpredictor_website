<?php
require_once 'db_connection.php';

// 1. Fetch user input (most recent entry)
$sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$userSkills = [];

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userSkills = array_map('strtolower', array_map('trim', explode(',', $row['skills'])));
}

// 2. Define career roles and their skills
$careerOptions = [
    'Data Scientist' => ['python', 'pandas', 'numpy', 'scikit-learn', 'matplotlib', 'seaborn', 'machine learning', 'sql', 'statistics', 'hadoop', 'spark', 'communication'],
    'Web Developer (Front-end)' => ['html', 'css', 'javascript', 'react', 'vue', 'angular', 'responsive design', 'git', 'ui/ux'],
    'Web Developer (Back-end)' => ['python', 'django', 'flask', 'php', 'ruby', 'node.js', 'mysql', 'postgresql', 'mongodb', 'restful apis', 'hosting', 'security', 'git'],
    'Software Engineer' => ['python', 'java', 'c++', 'c#', 'data structures', 'algorithms', 'oop', 'git', 'testing', 'debugging', 'agile'],
    'Machine Learning Engineer' => ['python', 'tensorflow', 'pytorch', 'scikit-learn', 'feature engineering', 'model deployment', 'aws', 'gcp', 'azure', 'linear algebra', 'statistics'],
    'UI/UX Designer' => ['figma', 'adobe xd', 'sketch', 'wireframing', 'prototyping', 'user testing', 'html', 'css', 'visual design'],
    'Cybersecurity Analyst' => ['network security', 'python', 'wireshark', 'metasploit', 'ethical hacking', 'risk assessment', 'gdpr', 'hipaa'],
];

// 3. Match calculation
$careers = [];
foreach ($careerOptions as $title => $skills) {
    $matchCount = count(array_intersect($userSkills, $skills));
    $matchPercent = round(($matchCount / count($skills)) * 100);
    $careers[] = [
        'title' => $title,
        'skills' => $skills,
        'match' => $matchPercent,
        'salary' => '$' . rand(60000, 120000) // placeholder
    ];
}

// Sort by match %
usort($careers, fn($a, $b) => $b['match'] <=> $a['match']);
foreach ($careers as $i => &$career) {
    $career['rank'] = $i + 1;
}
unset($career);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Career Matches</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1 class="match-heading">🔮 Your Top Career Matches</h1>
<p class="match-subheading">Based on your profile, here are the best-fit career options</p>

<?php foreach ($careers as $career): ?>
  <div class="career-card">
    <span class="rank-badge">#<?= $career['rank'] ?></span>
    <div class="career-title"><?= htmlspecialchars($career['title']) ?></div>
    <div class="salary">💰 Avg Salary: <?= htmlspecialchars($career['salary']) ?></div>
    <div class="skill-list">
      <?php foreach ($career['skills'] as $skill): ?>
        <span class="skill-chip <?= in_array(strtolower($skill), $userSkills) ? 'match' : '' ?>">
          <?= htmlspecialchars($skill) ?>
        </span>
      <?php endforeach; ?>
    </div>
    <div class="match-percent"><?= $career['match'] ?>%</div>
  </div>
<?php endforeach; ?>

</body>
</html>
