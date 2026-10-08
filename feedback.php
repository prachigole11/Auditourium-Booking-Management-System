<?php
$conn = new mysqli("localhost","root","","hall_booking");

if(isset($_POST['submit'])){
    $hall = $_POST['hall'];
    $organizer = $_POST['organizer'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    $conn->query("
        INSERT INTO feedback(hall_name,organizer_name,rating,comments)
        VALUES('$hall','$organizer','$rating','$comments')
    ");
}

$recent = $conn->query("
    SELECT * FROM feedback
    ORDER BY feedback_date DESC
    LIMIT 5
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Review & Feedback</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background:linear-gradient(135deg,#f5f7fa,#e4ecf7);
            font-family:'Segoe UI',sans-serif;
        }
        .page{
            padding:50px;
        }
        .card-box{
            background:#fff;
            border-radius:18px;
            box-shadow:0 20px 40px rgba(0,0,0,.08);
            padding:30px;
        }
        .title{
            font-weight:700;
            color:#0b2c4d;
        }
        .stars i{
            font-size:24px;
            color:#ccc;
            cursor:pointer;
        }
        .stars i.active{
            color:#f4b400;
        }
        .info-box{
            background:#f0f4fa;
            border-left:5px solid #0b5ed7;
            border-radius:12px;
            padding:20px;
        }
        .review{
            background:#f9fbff;
            border-radius:12px;
            padding:15px;
            margin-bottom:10px;
        }
    </style>
</head>

<body>

<div class="page container">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title">
            <i class="bi bi-chat-square-heart-fill"></i>
            Review & Feedback
        </h2>
        <a href="dashboard.php" class="btn btn-outline-secondary rounded-pill">
            ← Dashboard
        </a>
    </div>

    <div class="row g-4">

        <!-- FEEDBACK FORM -->
        <div class="col-md-6">
            <div class="card-box">
                <h5 class="mb-3">Share Your Experience</h5>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Organizer Name</label>
                        <input type="text" name="organizer" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hall</label>
                        <select name="hall" class="form-select" required>
                            <option value="">Select Hall</option>
                            <option>Mahatma Hall</option>
                            <option>Jijau Hall</option>
                            <option>Savitri Hall</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-select" required>
                            <option value="">Select Rating</option>
                            <option value="5">★★★★★ Excellent</option>
                            <option value="4">★★★★ Very Good</option>
                            <option value="3">★★★ Good</option>
                            <option value="2">★★ Fair</option>
                            <option value="1">★ Poor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Comments</label>
                        <textarea name="comments" rows="4" class="form-control"
                            placeholder="Share your experience, facilities, arrangements..." required></textarea>
                    </div>

                    <button name="submit" class="btn btn-primary w-100">
                        Submit Feedback
                    </button>
                </form>
            </div>
        </div>

        <!-- INFO + RECENT FEEDBACK -->
        <div class="col-md-6">

            <div class="info-box mb-4">
                <h6>Why your feedback matters</h6>
                <ul class="mb-0">
                    <li>Improves hall facilities & arrangements</li>
                    <li>Helps administration plan better</li>
                    <li>Enhances future event experience</li>
                    <li>Ensures transparency & quality</li>
                </ul>
            </div>

            <div class="card-box">
                <h6 class="mb-3">Recent Feedback</h6>

                <?php while($f = $recent->fetch_assoc()){ ?>
                <div class="review">
                    <strong><?php echo $f['organizer_name']; ?></strong>
                    <small class="text-muted">
                        (<?php echo $f['hall_name']; ?>)
                    </small>
                    <div>
                        <?php for($i=1;$i<=5;$i++){
                            echo $i <= $f['rating'] ? '⭐' : '☆';
                        } ?>
                    </div>
                    <small><?php echo $f['comments']; ?></small>
                </div>
                <?php } ?>

            </div>

        </div>

    </div>

</div>

</body>
</html>