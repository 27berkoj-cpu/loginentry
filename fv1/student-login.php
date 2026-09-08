<?php
session_start(); // Start the session to store submitted student information

$student = "";
$program = "";
$finalGrade = "";
$errors = [];
$submitted = false;
$showSubmittedInfo = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = true;
    $student = trim($_POST['student-name'] ?? '');
    $program = trim($_POST['program-name'] ?? '');
    $finalGrade = $_POST['student-grade'] ?? '';

    if (strlen($student) < 1 || strlen($student) > 100) {
        $errors[] = "Student name must be between 1 and 100 characters.";
    }

    if (empty($program)) {
        $errors[] = "Program is required.";
    } elseif (strlen($program) < 5 || strlen($program) > 20) {
        $errors[] = "Program name must be between 5 and 20 characters.";
    }

    if ($finalGrade === '' || $finalGrade === null) {
        $errors[] = "Final grade is required.";
    }
    elseif(filter_var($finalGrade, FILTER_VALIDATE_FLOAT) === false) {
        $errors[] = "Final grade must be a valid number.";
    }
    elseif (!is_numeric($finalGrade) || (float) $finalGrade < 0 || (float) $finalGrade > 100) {
        $errors[] = "Final grade must be a number between 0 and 100.";
    }

    if (empty($errors)) {
        $_SESSION['submitted_student'] = [
            'student' => $student,
            'program' => $program,
            'finalGrade' => (string) $finalGrade,
        ];

        header('Location: student-login.php?success=1');
        exit;
    }
} elseif (isset($_GET['success']) && $_GET['success'] === '1' && !empty($_SESSION['submitted_student'])) {
    $student = $_SESSION['submitted_student']['student'];
    $program = $_SESSION['submitted_student']['program'];
    $finalGrade = $_SESSION['submitted_student']['finalGrade'];
    $showSubmittedInfo = true;
    unset($_SESSION['submitted_student']);

    header('Refresh: 5; url=student-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <link rel="stylesheet" href="student.css">
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Student Enrollment Form</h1>
        <form action="#" method="post">
            <div>
                <label for="student-name" class="form-label">Student Name</label>
                <input type="text" id="student-name" name="student-name" class="form-input" required placeholder="Enter student's full name">
            </div>

            <div>
                <label for="program-name" class="form-label">Program</label>
                <input type="text" id="program-name" name="program-name" class="form-input" required placeholder="e.g., Computer Science">
            </div>

            <!-- <div>
                <label for="student-grade" class="form-label">Final Grade</label>
                <input type="number" id="student-grade" name="student-grade" step="0.01" min="0" max="100" class="form-input" required placeholder="e.g., 95.5">
            </div> -->


            <div>
                <label for="student-grade" class="form-label">Final Grade</label>
                <input type="text" id="student-grade" name="student-grade" class="form-input" required placeholder="e.g., 95.5">
            </div>

            <button type="submit" class="form-button">Submit Information</button>
        </form>

        <?php if ($showSubmittedInfo): ?>
            <div class="success-message">Student information submitted successfully!</div>
            <div class="submitted-info">
                <p><strong>Student Name:</strong> <?php echo htmlspecialchars($student, ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Program:</strong> <?php echo htmlspecialchars($program, ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Final Grade:</strong> <?php echo htmlspecialchars($finalGrade, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        <?php elseif ($submitted && !empty($errors)): ?>
            <div class="error-messages">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
