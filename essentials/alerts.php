<?php
    if (isset($_SESSION['unAuth'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"" >
        <strong>Not registerd in Mess!</strong> please contact administrator.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      session_unset();
      session_destroy();
    } else if (isset($_SESSION['exist'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <strong>User already exists!</strong>please login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        session_unset();
        session_destroy();
    } else if (isset($_SESSION['notMatch'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <strong>Passwords donot match!</strong> You should enter the passwords carefully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        session_unset();
        session_destroy();
    }
    ?>