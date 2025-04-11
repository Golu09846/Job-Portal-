<?php include('includes/db.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Job Details | Job Portal</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      padding-top: 120px;
      /* fixes everything under fixed navbar */
    }

    .job-section {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 40px;
      border-radius: 15px;
      margin: 0 auto 40px;
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(8px);
    }


    .nav-tabs .nav-link {
      background-color: transparent;
      border: none;
      font-weight: 600;
      color: #90ee90;
    }

    .nav-tabs .nav-link.active {
      background-color: #00d4ff;
      color: #000;
      border-radius: 8px;
    }

    h2 {
      color: #00d4ff;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .job-info p {
      font-size: 1.05rem;
      margin-bottom: 8px;
    }

    .job-info strong {
      color: #90ee90;
    }

    .section-title {
      font-size: 1.2rem;
      color: #00d4ff;
      margin-top: 20px;
      font-weight: 600;
    }

    ul {
      padding-left: 1.2rem;
    }

    li {
      margin-bottom: 6px;
    }

    .btn-primary {
      background: linear-gradient(135deg, #00d4ff, #0088cc);
      border: none;
      padding: 10px 20px;
      font-weight: 600;
      border-radius: 10px;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #0088cc, #00d4ff);
    }

    .footer {
      background-color: #000;
      padding: 20px 0;
      text-align: center;
      color: #aaa;
      margin-top: 60px;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <?php include('includes/navbar.php'); ?>

  <!-- Job Tabs -->
  <div class="container">
    <ul class="nav nav-tabs justify-content-center mt-5" id="jobTab" role="tablist">
      <?php
      $result = mysqli_query($conn, "SELECT * FROM jobs");
      $i = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        $activeClass = ($i === 0) ? 'active' : '';
        echo '<li class="nav-item">
          <a class="nav-link ' . $activeClass . '" id="job' . $row['job_id'] . '-tab" data-toggle="tab" href="#job' . $row['job_id'] . '" role="tab">' . htmlspecialchars($row['title']) . '</a>
        </li>';
        $i++;
      }
      ?>
    </ul>
  </div>

  <!-- Job Details Section -->
  <section class="container">
    <div class="tab-content" id="jobTabContent">
      <?php
      mysqli_data_seek($result, 0); // reset pointer
      $i = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        $activePane = ($i === 0) ? 'show active' : '';
        ?>
        <div class="tab-pane fade <?php echo $activePane; ?> job-section" id="job<?php echo $row['job_id']; ?>"
          role="tabpanel">
          <h2><?php echo htmlspecialchars($row['title']); ?></h2>
          <div class="job-info">
            <p><strong>Company:</strong> <?php echo htmlspecialchars($row['company_name']); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
            <p><strong>Job Type:</strong> Full-time</p>
            <p><strong>Salary:</strong> <?php echo htmlspecialchars($row['salary_range']); ?></p>
            <p><strong>Experience Required:</strong> 2+ years</p>
            <p><strong>Application Deadline:</strong>
              <?php echo date('F d, Y', strtotime($row['created_at'] . ' +30 days')); ?></p>

            <p class="section-title">Responsibilities:</p>
            <ul>
              <?php if ($row['title'] == "Software Developer") { ?>
                <li>Develop and maintain web applications using JavaScript, React, and Node.js</li>
                <li>Collaborate with cross-functional teams on product features</li>
                <li>Write clean, scalable, and well-documented code</li>
                <li>Participate in code reviews and agile ceremonies</li>
              <?php } elseif ($row['title'] == "UI/UX Designer") { ?>
                <li>Design user interfaces and user journeys for mobile and web apps</li>
                <li>Create wireframes, prototypes, and conduct user testing</li>
                <li>Collaborate closely with developers and product managers</li>
              <?php } elseif ($row['title'] == "Data Analyst") { ?>
                <li>Analyze complex datasets to identify trends and patterns</li>
                <li>Create dashboards and reports for stakeholders</li>
                <li>Work with product teams to guide data-driven decisions</li>
              <?php } else { ?>
                <li>Refer to the job description for responsibilities.</li>
              <?php } ?>
            </ul>

            <p class="section-title">Required Skills:</p>
            <p>
              <?php
              if ($row['title'] == "Software Developer") {
                echo "JavaScript, React, Node.js, SQL, REST APIs, Git";
              } elseif ($row['title'] == "UI/UX Designer") {
                echo "Figma, Adobe XD, HTML/CSS, UX Research, Prototyping";
              } elseif ($row['title'] == "Data Analyst") {
                echo "Python, SQL, Tableau, Data Cleaning, Reporting, Excel";
              } else {
                echo "Relevant to the position.";
              }
              ?>
            </p>

            <p class="section-title">Perks & Benefits:</p>
            <ul>
              <li>Remote work flexibility</li>
              <li>Health & dental insurance</li>
              <li>Learning and development budget</li>
              <li>Stock options</li>
            </ul>
          </div>
          <a href="apply-form.php?job=<?php echo urlencode($row['title']); ?>" class="btn btn-primary mt-3">Apply Now</a>
        </div>
        <?php
        $i++;
      }
      ?>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2025 JobPortal. All Rights Reserved.</p>
  </footer>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>