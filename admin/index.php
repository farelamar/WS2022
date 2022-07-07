<?php include("../functions.php");
if ((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])))  header("Location: login.php");
if ($_SESSION['user_level'] != "admin") header("Location: login.php"); ?> <?php include 'header.php'; ?><div class="col-12 col-md-3"> <img class="img-fluid" src="../image/bg-2.png" /></div>
<div class="col-12 col-md-6 p-3 p-md-5 text-center">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist"> <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Welcome</button> <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Contact</button> <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Tentang</button></div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <p>Selamat Datang Admin, ini adalah aplikasi kasir restoran anda.</p>
        </div>
        <div class="tab-pane fade p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <p> Hubungi pembuat untuk menanyakan cara penggunaan</p>
        </div>
        <div class="tab-pane fade p-3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <p> Aplikasi ini dibuat dengan bahasa pemograman PHP dan MySQL</p>
        </div>
    </div>
</div>
<div class="col-12 col-md-3 p-3">
    <div class="p-3 p-md-5 bg-dark text-white">
        <p> Follow juga akun sosial media kami dibawah ini</p> <a href="#" class="btn btn-outline-warning col-12">Facebook</a> <a href="#" class="btn btn-outline-warning col-12">Instagram</a> <a href="#" class="btn btn-outline-warning col-12">Youtube</a> <a href="#" class="btn btn-outline-warning col-12">Tiktok</a>
    </div>
</div>
<div class="col-12 col-md-12">
    <div class="border border-dark rounded p-3 text-center"> Aplikasi Kasir dan POS pada restoran </div>
</div><?php include 'footer.php'; ?>