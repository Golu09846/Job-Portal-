<?php
include('includes/db.php');

$jobTitle = isset($_GET['job']) ? htmlspecialchars($_GET['job']) : 'Unknown Position';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_application'])) {
  $fullname = trim(mysqli_real_escape_string($conn, $_POST['fullname']));
  $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
  $coverletter = trim(mysqli_real_escape_string($conn, $_POST['coverletter']));
  $job = trim(mysqli_real_escape_string($conn, $_POST['job']));

  if (empty($fullname) || empty($email) || empty($job)) {
    $error = "All fields are required.";
  } else {
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
      $resumeName = $_FILES['resume']['name'];
      $resumeTmp = $_FILES['resume']['tmp_name'];
      $resumeExt = strtolower(pathinfo($resumeName, PATHINFO_EXTENSION));
      $allowedExts = ['pdf', 'doc', 'docx'];

      if (in_array($resumeExt, $allowedExts)) {
        $newResumeName = uniqid('resume_', true) . '.' . $resumeExt;
        $uploadDir = 'resumes/';
        $uploadPath = $uploadDir . $newResumeName;

        if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($resumeTmp, $uploadPath)) {
          $sql = "INSERT INTO applications (job_title, full_name, email, resume_file, cover_letter) VALUES (?, ?, ?, ?, ?)";
          $stmt = $conn->prepare($sql);

          if (!$stmt) {
            $error = "Database error: " . $conn->error;
          } else {
            $stmt->bind_param("sssss", $job, $fullname, $email, $newResumeName, $coverletter);
            if ($stmt->execute()) {
              $success = "🎉 Your application for <b>$job</b> has been submitted successfully!";
            } else {
              $error = "Execute failed: " . $stmt->error;
            }
            $stmt->close();
          }
        } else {
          $error = "Failed to upload resume. Please try again.";
        }
      } else {
        $error = "Invalid file type. Only PDF, DOC, and DOCX files are allowed.";
      }
    } else {
      $error = "Please upload your resume.";
    }
  }
}
?>

<?php include('includes/head.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('includes/style.php'); ?>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    color: #fff;
    min-height: 100vh;
    padding-top: 80px;
  }

  .apply-container {
    background: rgba(0, 0, 0, 0.75);
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.7);
    max-width: 600px;
    margin: auto;
  }

  h2 {
    color: #00d4ff;
    margin-bottom: 25px;
    font-weight: 600;
    text-align: center;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    font-weight: 500;
    display: block;
    margin-bottom: 8px;
  }

  .form-control {
    border-radius: 10px;
    background-color: #222;
    border: 1px solid #555;
    color: #fff;
    padding: 12px 15px;
    width: 100%;
  }

  .form-control:focus {
    border-color: #00d4ff;
    box-shadow: 0 0 8px #00d4ff;
    outline: none;
    background-color: #111;
  }

  .btn-primary {
    background: linear-gradient(135deg, #00d4ff, #0088cc);
    border: none;
    border-radius: 10px;
    font-weight: 600;
    padding: 12px;
    width: 100%;
    transition: 0.3s ease;
    color: #000;
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, #0088cc, #00d4ff);
    transform: translateY(-2px);
  }

  .back-link {
    display: block;
    margin-top: 20px;
    text-align: center;
    color: #90ee90;
  }

  .back-link:hover {
    text-decoration: underline;
  }

  .custom-file-upload {
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: rgba(255, 255, 255, 0.05);
    padding: 12px 15px;
    border-radius: 12px;
    border: 1px solid #00d4ff55;
    cursor: pointer;
  }

  .custom-file-upload input[type="file"] {
    display: none;
  }

  .custom-file-upload label {
    background-color: #00d4ff;
    color: #000;
    padding: 6px 14px;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
  }

  .custom-file-upload label:hover {
    background-color: #0088cc;
    color: #fff;
  }

  #file-chosen {
    color: #ccc;
    font-size: 0.9rem;
    word-break: break-word;
  }

  .message {
    text-align: center;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 20px;
  }

  .success {
    background-color: #28a74533;
    color: #90ee90;
  }

  .error {
    background-color: #ff4d4d33;
    color: #ff4d4d;
  }
</style>

<body>
<?php include('includes/navbar.php'); ?>
  <div class="apply-container">
    <h2>Apply for <?= $jobTitle ?></h2>

    <?php if ($success): ?>
      <div class="message success"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="message error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="job" value="<?= htmlspecialchars($jobTitle) ?>">

      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Upload Resume</label>
        <div class="custom-file-upload">
          <input type="file" name="resume" id="resume" required>
          <label for="resume">Choose File</label>
          <span id="file-chosen">No file chosen</span>
        </div>
      </div>

      <div class="form-group">
        <label for="coverletter">Cover Letter</label>
        <textarea name="coverletter" id="coverletter" rows="5" class="form-control" placeholder="Why should we hire you?"></textarea>
      </div>

      <button type="submit" name="submit_application" class="btn btn-primary">Submit Application</button>
    </form>
    <a href="job-details.php" class="back-link">&larr; Back to Job Listings</a>
  </div>

  <script>
    const fileInput = document.getElementById("resume");
    const fileChosen = document.getElementById("file-chosen");

    fileInput.addEventListener("change", function () {
      fileChosen.textContent = this.files.length ? this.files[0].name : "No file chosen";
    });
  </script>
</body>
</html>
