<?php
include 'db_config.php'; // Koneksi ke database

$response = ""; // Variabel untuk menyimpan pesan sukses/error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = "Alamat email tidak valid!";
    } else if (!empty($name) && !empty($email) && !empty($message)) {
        // Menggunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("INSERT INTO contacts (full_name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

        if ($stmt->execute()) {
            // Kirim email ke pemilik situs
            $to = "wahyuozorahmanurung@gmail.com"; // Email Anda
            $headers = "From: $email";
            $fullMessage = "Name: $name\nEmail: $email\nPhone: $phone\nMessage:\n$message";

            if (mail($to, $subject, $fullMessage, $headers)) {
                $response = "Pesan Anda berhasil dikirim!";
            } else {
                $response = "Pesan tersimpan, tetapi gagal mengirim email.";
            }
        } else {
            $response = "Terjadi kesalahan: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $response = "Semua field harus diisi!";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Faza</title>
</head>

<body>
    
    <!-- Header Section -->

    <header>
        <a href="#home" class="logo">Faza Dafina Putri Sarma</a>

        <div class='bx bx-menu' id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>

        <div class="top-btn">
            <a href="#contact" class="nav-btn">Contact Me</a>
        </div>
    </header>

    <!-- Contact Section Code -->

    <section class="contact" id="contact">

        <h2 class="heading">Contact <span>Me</span></h2>

        <form action="#">
            <div class="input-box">
                <input type="text" placeholder="Full Name">
                <input type="email" placeholder="Email Address">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Phone Number">
                <input type="text" placeholder="Email Subject">
            </div>

            <textarea name="message" id="" cols="30" rows="10" placeholder="Your Message"></textarea>

            <input type="submit" value="Send Message" class="btn">
        </form>

    </section>

        <!-- Menampilkan Respons -->
        <?php if (!empty($response)): ?>
            <p class="response-message"><?php echo htmlspecialchars($response); ?></p>
        <?php endif; ?>
    </section>

    <!-- Footer Section Code -->

    <footer class="footer">
        <div class="social">
            <a href="https://www.instagram.com/fzdafina"><i class='bx bxl-instagram'></i></a>
            <a href="https://www.youtube.com/@FazaDafinaPutri"><i class='bx bxl-youtube'></i></a>
        </div>

        <p class="copyright">
            &copy; faza@2024
        </p>
    </footer>

    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script src="script.js"></script>
</body>

</html>
