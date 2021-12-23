<?php include("./analytics.php"); ?>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="./" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="32" height="32"><img src="<?php echo $icon_loc; ?>" style='width: 32px; margin-right: 5px;'/></svg>
        <h1 class="fs-4" style='text-weight: normal;'><?php echo $domainName; ?></h1>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="./" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="./compress-jpeg-to-100kb-online.php" class="nav-link">Compress to 100KB</a></li>
        <li class="nav-item"><a href="./about-us.php" class="nav-link">About Us</a></li>
        <li class="nav-item"><a href="./contact-us.php" class="nav-link">Contact Us</a></li>
        <li class="nav-item"><a href="./privacy-policy.php" class="nav-link">Privacy Policy</a></li>
      </ul>
    </header>
</div>