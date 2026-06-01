<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
    <script src="https://kit.fontawesome.com/3a03b4384b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/friends.css">
    <script src="../script/global.js" defer></script>
    <script src="../script/friends.js" defer></script>
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
            <div id="img-memories" class="liquidGlass-wrapper" onclick="navigationTo('pages/profile.php?gallery=true')">
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

    <div id="friends-profile" onclick="navigationTo('pages/profile.php')">
        <img id="friends-profile-image" src="" alt="demo user">
    </div>

    <div id="friends-main-section">
        <div id="friends-main-section-header">
            <div id="friends-main-section-summary">
                <h2>Your friends</h2>
                <h3 id="friend-count"></h3>
            </div>
            <div id="friends-main-section-add" onclick="openAddFriends()">
                <i class="fa-solid fa-plus"></i>
            </div>
        </div>
        <div id="friends-main-section-main-content">
            <div id="friends-main-section-navigation">
                <div class="friends-main-section-nav-item active-friends-nav-item"
                    onclick="setActiveClass(this,'friends-main-section-nav-item', 'active-friends-nav-item'); setFriendsMainSection('grid');">
                    <p>Friend list</p>
                </div>
                <div class="friends-main-section-nav-item"
                    onclick="setActiveClass(this,'friends-main-section-nav-item', 'active-friends-nav-item'); setFriendsMainSection('flex1');">
                    <p>Friend requests</p>
                </div>
            </div>
            <div id="friends-main-section-content">

            </div>
        </div>
    </div>

    <div id="add-friends-section">
        <div id="add-friends-flex-container" class="liquidGlass-wrapper">

            <div id="close-friends-flex-container" onclick="closeAddFriends()">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <div class="liquidGlass-effect-less-blur"></div>
            <div class="liquidGlass-tint-less-blur"></div>
            <div class="liquidGlass-shine-less-blur"></div>
            <h3>Add Friends</h3>

            <div id="add-friends-search-bar">
                <div id="add-friends-search-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="text" placeholder="Search ..." id="add-friends-search-input" oninput="searchUsers()">
            </div>

            <div id="add-friends-friends-found">
                
            </div>
        </div>
    </div>
</body>

</html>