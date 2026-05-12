<?php
require '../global-functions.php';

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['myData']) && $_GET['myData'] === 'true') {
    $showMyData = true;
} else {
    $showMyData = false;
}

if (isset($_GET['badge'])) {
    $showBadge = true;
} else {
    $showBadge = false;
}

$user = $_SESSION['user'] ?? null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://kit.fontawesome.com/3a03b4384b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/profile.css">
    <script src="../script/global.js" defer></script>
    <script src="../script/profile.js" defer></script>
</head>

<body>
    <div id="error-flex">
        <?php printErrors() ?>
    </div>
    <!-- Navigation start -->
    <div id="top-level-blur">

    </div>
    <div id="navigation">
        <div id="navigation-header">
            <a href="../index.html">AfterMemory</a>
            <div id="navigation-inner-toggle-button" onclick="toggleNavigation()">
                <i class="fa-solid fa-caret-right"></i>
            </div>
        </div>
        <div id="navigation-links">
            <div id="prev-event" class="liquidGlass-wrapper">
                <div class="liquidGlass-effect-less-blur"></div>
                <div class="liquidGlass-tint-less-blur"></div>
                <div class="liquidGlass-shine-less-blur"></div>
                <div class="opacity-overlay"></div>

                <div id="prev-event-desc">
                    <div id="prev-event-headline">
                        <p>Last Event</p>
                    </div>
                    <div id="prev-event-details">
                        <p id="prev-event-name">Demo Party</p>
                        <p>-</p>
                        <p id="prev-event-date">01.01.2024</p>
                    </div>
                </div>
                <div id="prev-event-edit" class="liquidGlass-wrapper">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <i class="fa-solid fa-pen"></i>
                </div>
            </div>
            <div id="pages-links">
                <div class="link-container">
                    <div class="link-icon liquidGlass-wrapper" onclick="navigationTo('index.html')">
                        <div class="liquidGlass-effect"></div>
                        <div class="liquidGlass-tint"></div>
                        <div class="liquidGlass-shine"></div>
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <p>Home</p>
                </div>
                <div class="link-container">
                    <div class="link-icon liquidGlass-wrapper" onclick="navigationTo('pages/events.php')">
                        <div class="liquidGlass-effect"></div>
                        <div class="liquidGlass-tint"></div>
                        <div class="liquidGlass-shine"></div>
                        <i class="fa-solid fa-martini-glass-citrus"></i>
                    </div>
                    <p>Events</p>
                </div>
                <div class="link-container">
                    <div class="link-icon liquidGlass-wrapper" onclick="navigationTo('pages/friends.php')">
                        <div class="liquidGlass-effect"></div>
                        <div class="liquidGlass-tint"></div>
                        <div class="liquidGlass-shine"></div>
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <p>Friends</p>
                </div>
            </div>
            <div id="img-memories" class="liquidGlass-wrapper">
                <h2>Memories</h2>
                <div class="liquidGlass-effect-less-blur"></div>
                <div class="liquidGlass-tint-less-blur"></div>
                <div class="liquidGlass-shine-less-blur"></div>
                <div class="opacity-overlay"></div>
            </div>
        </div>
    </div>

    <div id="open-navigation">
        <div id="open-navigation-icon" onclick="toggleNavigation()">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    <!-- Navigation end -->

    <div id="profile-flex">
        <div id="profile-header">
            <div id="profile-picture">
                <img id="profile-image" src="" alt="profile image">
            </div>

            <div id="profile-name-and-badges">
                <h2><?php echo htmlspecialchars($user['username'] ?? 'Guest'); ?></h2>
                <p onclick="openBadges()">view badges</p>
            </div>
        </div>
        <hr class="seperator">
        <div id="profile-subpoints">
            <div class="profile-subpoint">
                <h3>Profile</h3>
                <div class="profile-point-flex liquidGlass-wrapper">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <div class="profile-point" onclick="openMyDataSection()">
                        <div class="profile-point-icon-text">
                            <div class="profile-point-icon">
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <p>My Data</p>
                        </div>
                        <div class="profile-point-arrow">
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                    <hr class="seperator-long">
                    <div class="profile-point">
                        <div class="profile-point-icon-text">
                            <div class="profile-point-icon">
                                <i class="fa-regular fa-image"></i>
                            </div>
                            <p>Gallery</p>
                        </div>
                        <div class="profile-point-arrow">
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-subpoint">
                <h3>Settings</h3>
                <div class="profile-point-flex liquidGlass-wrapper">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <div class="profile-point">
                        <div class="profile-point-icon-text">
                            <div class="profile-point-icon">
                                <i class="fa-solid fa-palette"></i>
                            </div>
                            <p>Design</p>
                        </div>
                        <div class="profile-point-arrow">
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                    <hr class="seperator-long">
                    <div class="profile-point" onclick="navigationTo('pages/events.php')">
                        <div class="profile-point-icon-text">
                            <div class="profile-point-icon">
                                <i class="fa-solid fa-martini-glass-empty"></i>
                            </div>
                            <p>Events</p>
                        </div>
                        <div class="profile-point-arrow">
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                    <hr class="seperator-long">
                    <div class="profile-point">
                        <div class="profile-point-icon-text">
                            <div class="profile-point-icon">
                                <i class="fa-solid fa-fingerprint"></i>
                            </div>
                            <p>Privacy</p>
                        </div>
                        <div class="profile-point-arrow">
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="logout" onclick="logout()">
            <p>Logout</p>
        </div>
    </div>

    <div id="profile-badge-slider">
        <div id="close-badge-slider-icon" onclick="closeBadges()">
            <i class="fa-solid fa-xmark"></i>
        </div>

        <div id="profile-badge-slider-header">
            <h2>Your Badges</h2>
            <p>Click them to edit.</p>
        </div>

        <div id="add-badges-button" onclick="openBadgeSlider()">
            <p>Add Badges</p>
        </div>

        <hr id="user-badge-content-seperator">

        <div id="profile-badges"></div>

    </div>

    <div id="profile-my-data-slider">
        <div id="profile-my-data-header">
            <div id="close-my-data-icon" class="liquidGlass-wrapper" onclick="closeMyDataSection()">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>
                <i class="fa-solid fa-angle-left"></i>
            </div>

            <h2>My Data</h2>
            <div></div>
        </div>

        <form id="profile-my-data-form" action="../../api/login-register/update-profile.php" method="POST"
            enctype="multipart/form-data">

            <div class="my-data-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="my-data-section-header">
                    <div class="my-data-section-icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <p>Account</p>
                </div>

                <div class="my-data-group">
                    <label for="my-data-username">Username</label>
                    <input type="text" id="my-data-username" name="username"
                        value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>">
                </div>

                <div class="my-data-group">
                    <label for="my-data-email">Email</label>
                    <input type="email" id="my-data-email" name="email"
                        value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
                </div>
            </div>

            <div class="my-data-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="my-data-section-header">
                    <div class="my-data-section-icon">
                        <i class="fa-regular fa-image"></i>
                    </div>
                    <p>Profile Image</p>
                </div>

                <div class="my-data-group">
                    <label for="my-data-profile-image">Select image to upload</label>
                    <input type="hidden" name="user-id" value="<?php echo htmlspecialchars($user['userid'] ?? ''); ?>">
                    <input type="file" id="my-data-profile-image" name="profile-image" accept="image/*">
                </div>
            </div>

            <div class="my-data-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="my-data-section-header">
                    <div class="my-data-section-icon">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <p>Personal Information</p>
                </div>

                <div class="my-data-grid">
                    <div class="my-data-group">
                        <label for="my-data-firstname">Firstname</label>
                        <input type="text" id="my-data-firstname" name="firstname"
                            value="<?php echo htmlspecialchars($user['firstname'] ?? ''); ?>">
                    </div>

                    <div class="my-data-group">
                        <label for="my-data-lastname">Lastname</label>
                        <input type="text" id="my-data-lastname" name="lastname"
                            value="<?php echo htmlspecialchars($user['lastname'] ?? ''); ?>">
                    </div>
                </div>

                <div class="my-data-group">
                    <label for="my-data-dob">Date of Birth</label>
                    <input type="date" id="my-data-dob" name="dob"
                        value="<?php echo htmlspecialchars(isset($user['dob']) ? substr((string) $user['dob'], 0, 10) : ''); ?>">
                </div>
            </div>

            <div class="my-data-actions">
                <div type="button" class="my-data-btn-cancel" onclick="closeMyDataSection()">Cancel</div>
                <input type="submit" id="my-data-submit" class="my-data-btn-submit" value="Save Changes" name="submit">
            </div>

        </form>
    </div>
    <div id="badge-info">
        <div id="close-badge-info" class="liquidGlass-wrapper" onclick="closeBadgeInfo()">
            <div class="liquidGlass-effect"></div>
            <div class="liquidGlass-tint"></div>
            <div class="liquidGlass-shine"></div>

            <i class="fa-solid fa-xmark"></i>
        </div>

        <div id="badge-info-content">
            <div id="badge-info-img">
            </div>
            <div id="badge-info-text">
                <h2 id="badge-info-name">Badge Name</h2>
                <p id="badge-info-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lacinia mi
                    quis euismod ultrices.</p>
            </div>
            <div id="remove-badge">
                <i class="fa-solid fa-trash"></i>
            </div>
        </div>
    </div>

    <div id="badge-select-slider">
        <div id="close-badge-select-slider" class="liquidGlass-wrapper" onclick="closeBadgeSlider()">
            <div class="liquidGlass-effect"></div>
            <div class="liquidGlass-tint"></div>
            <div class="liquidGlass-shine"></div>

            <i class="fa-solid fa-xmark"></i>
        </div>

        <form id="badge-select-form" action="../../api/badge-api.php" method="POST">
            <input type="hidden" id="selected-badges" name="selectedBadges" value="[]">

            <div id="inner-select-slider">
                <h3>Select your badges</h3>

                <div id="badge-slider">

                </div>

                <input type="submit" id="badges-add" value="Add" name="submit-badges">
            </div>
        </form>
    </div>
</body>

</html>