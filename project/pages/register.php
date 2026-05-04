<?php
session_start();

if(isset($_SESSION['register_error'])){
    
    unset($_SESSION['register_error']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://kit.fontawesome.com/3a03b4384b.js" crossorigin="anonymous"></script>
    <script src="../script/global.js" defer></script>
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/register-login.css">
    <script src="../script/register-login.js" defer></script>
</head>

<body>
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

    <div id="register-box">
        <div id="register-header">
            <h2>Register</h2>
            <p>Register to start your experience</p>
        </div>

        <form id="register-form" action="../../api/login-register/register.php" method="POST">
            <div class="register-form-part-box liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="register-form-item">
                    <label for="register-username">Username</label>
                    <input name="register-username" type="text" id="register-username" placeholder="Username" required>
                </div>
                <div class="register-form-part-box-align-row">
                    <div class="register-form-item">
                        <label for="register-firstname">Firstname</label>
                        <input name="register-firstname" type="text" id="register-firstname" placeholder="Firstname"
                            required>
                    </div>
                    <div class="register-form-item">
                        <label for="register-lastname">Lastname</label>
                        <input name="register-lastname" type="text" id="register-lastname" placeholder="Lastname"
                            required>
                    </div>
                </div> 
                <div id="badge-select-box" onclick="openBadgeSlider()">
                    <div id="badge-add-icon">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
            </div>
            <div class="register-form-part-box liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="register-form-item">
                    <label for="register-email">Email</label>
                    <input name="register-email" type="email" id="register-email" placeholder="Email" required>
                </div>
                <div class="register-form-item">
                    <label for="register-dob">When were you born?</label>
                    <input name="register-dob" type="date" id="register-dob" required>
                </div>
            </div>
            <div class="register-form-part-box liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="register-form-item">
                    <label for="register-password">Password</label>
                    <input name="register-password" type="password" id="register-password" placeholder="Password"
                        required>
                </div>
                <div class="register-form-item">
                    <label for="register-password-repeat">Repeat Password</label>
                    <input name="register-password-repeat" type="password" id="register-password-repeat"
                        placeholder="Repeat Password" required>
                </div>
            </div>
            <input type="hidden" name="register-badges" id="register-badges" value="">
            <a class="switch-login-register-mode-link" href="./login.php">Already have an account? Login here.</a>
            <input type="submit" value="Register" name="submit">
        </form>
    </div>

    <div id="badge-select-slider">
        <div id="close-badge-select-slider" class="liquidGlass-wrapper" onclick="closeBadgeSlider()">
            <div class="liquidGlass-effect"></div>
            <div class="liquidGlass-tint"></div>
            <div class="liquidGlass-shine"></div>
            
            <i class="fa-solid fa-xmark"></i>
        </div>

        <div id="inner-select-slider">
            <h3>Select your badges</h3>

            <div id="badge-slider">
                
            </div>
        </div>
    </div>
</body>

</html>