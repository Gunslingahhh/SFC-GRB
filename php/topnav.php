<?php
// topnav.php
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <a href="<?php echo $buttonLink; ?>" class="me-5">
                <button type="button" class="btn btn-primary"><?php echo $buttonText; ?></button>
            </a>
            <form class="d-flex me-2" role="search" action="<?php echo $searchAction; ?>" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="<?php echo $searchPlaceholder; ?>" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>