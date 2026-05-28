<?php
require '../global-functions.php';

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <script src="https://kit.fontawesome.com/3a03b4384b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/events.css">
    <script src="../script/global.js" defer></script>
    <script src="../script/events.js" defer></script>
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

    <div id="main-content">
        <h1>Events</h1>

        <div id="filter-section">
            <div id="filter-advanced-selection" class="liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div id="filter-advanced-icon">
                    <i class="fa-solid fa-filter"></i>
                </div>
                <p>Filter Events</p>
            </div>
            <div id="filter-more-info">
                <div id="smart-filter-date-add">
                    <div id="smart-filter-date" class="liquidGlass-wrapper">
                        <div class="liquidGlass-effect"></div>
                        <div class="liquidGlass-tint"></div>
                        <div class="liquidGlass-shine"></div>

                        <div id="smart-filter-date-icon">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <p>Week</p>
                    </div>
                    <div id="add-event-button" class="liquidGlass-wrapper" onclick="openAddEventSlider()">
                        <div class="liquidGlass-effect"></div>
                        <div class="liquidGlass-tint"></div>
                        <div class="liquidGlass-shine"></div>

                        <div id="add-event-button-icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                </div>
                <p>Click event to see details</p>
            </div>
        </div>
        <hr class="seperator-long">

        <div id="event-flex">

        </div>


    </div>

    <div id="event-detail-slider">
        <div id="event-details-header">
            <div id="event-details-header-left">
                <div id="close-detail-event-icon" onclick="closeEvent()">
                    <i class="fa-solid fa-angle-left"></i>
                </div>
                <p id="event-title-header">Event Title</p>
            </div>
            <div id="event-details-header-right">
                <div id="add-user-to-event-icon">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                </div>
            </div>
        </div>
        <div id="event-details-main-image">
            <div class="opacity-overlay"></div>
            <div id="event-info-headline-date-desc">
                <div id="event-info-date-card">
                    <p id="date-card-month">Mai</p>
                    <p id="date-card-day">08</p>
                    <p id="date-card-year">2026</p>
                </div>
                <div id="event-info-headline-desc">
                    <h3 id="event-info-headline">Event headline</h3>
                    <p id="event-info-desc">Event description</p>
                    <div id="event-shared-with" class="liquidGlass-wrapper">
                        <div class="liquidGlass-effect"></div>
                        <div class="liquidGlass-tint"></div>
                        <div class="liquidGlass-shine"></div>

                        <div id="event-shared-with-content">
                            <div id="shared-with-icon">
                                <i class="fa-solid fa-user-group"></i>
                            </div>
                            <p id="event-shared-with-text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="event-info-flex">
            <div class="event-info" id="event-info-full-description-box">
                <div class="event-info-header">
                    <div class="event-info-header-icon">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                    <p>Description</p>
                </div>
                <p id="event-info-full-description"></p>
            </div>
            <div id="event-info-grid">
                <div class="event-info" id="event-info-date-box">
                    <div class="event-info-header">
                        <div class="event-info-header-icon">
                            <i class="fa-regular fa-calendar-days"></i>
                        </div>
                        <p>Date</p>
                    </div>
                    <p id="event-info-date"></p>
                    <p id="event-info-time"></p>
                </div>
                <div class="event-info">
                    <div class="event-info-header">
                        <div class="event-info-header-icon">
                            <i class="fa-solid fa-person-dress"></i>
                        </div>
                        <p>Dress Code</p>
                    </div>
                    <p id="event-info-dress-code"></p>
                </div>
                <div class="event-info">
                    <div class="event-info-header">
                        <div class="event-info-header-icon">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <p>Duration</p>
                    </div>
                    <p id="event-info-duration"></p>
                </div>
                <div class="event-info" id="event-info-ranking-box">
                    <div class="event-info-header">
                        <div class="event-info-header-icon">
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p>Ranking</p>
                    </div>
                    <p id="event-info-ranking"></p>
                </div>
            </div>
            <div class="event-info" id="event-info-location-box">
                <div class="event-info-header">
                    <div class="event-info-header-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <p>Location</p>
                </div>
                <p id="event-info-location-name"></p>
                <p id="event-info-location-description"></p>
            </div>
            <div class="event-info" id="event-info-event-details-grid">
                <div class="event-info-grid-item" id="event-info-details-shared-with">
                    <div class="event-info-grid-item-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <p id="event-info-details-shared-with-count"></p>
                    <p class="event-info-grid-item-text">shared</p>
                </div>
                <div class="event-info-grid-item" id="event-info-details-created-at-box">
                    <div class="event-info-grid-item-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <p id="event-info-details-date-created-on"></p>
                    <p class="event-info-grid-item-text">created at</p>
                </div>
            </div>

            <div class="event-info" id="drinks-snacks-games-images-shared-with-event-info">
                <div id="drinks-snacks-games-images-shared-with-grid-nav">
                    <div class="drinks-snacks-games-images-shared-with-grid-nav-item active"
                        onclick="setActiveClass(this, 'drinks-snacks-games-images-shared-with-grid-nav-item', 'active'); showDrinks(activeEventId);">
                        <div class="drinks-snacks-games-images-shared-with-grid-nav-item-icon">
                            <i class="fa-solid fa-martini-glass-citrus"></i>
                        </div>
                        <p>Drinks</p>
                    </div>
                    <div class="drinks-snacks-games-images-shared-with-grid-nav-item"
                        onclick="setActiveClass(this, 'drinks-snacks-games-images-shared-with-grid-nav-item', 'active'); showSnacks(activeEventId);">
                        <div class="drinks-snacks-games-images-shared-with-grid-nav-item-icon">
                            <i class="fa-solid fa-burger"></i>
                        </div>
                        <p>Snacks</p>
                    </div>
                    <div class="drinks-snacks-games-images-shared-with-grid-nav-item"
                        onclick="setActiveClass(this, 'drinks-snacks-games-images-shared-with-grid-nav-item', 'active'); showGames(activeEventId);">
                        <div class="drinks-snacks-games-images-shared-with-grid-nav-item-icon">
                            <i class="fa-solid fa-dice"></i>
                        </div>
                        <p>Games</p>
                    </div>
                    <div class="drinks-snacks-games-images-shared-with-grid-nav-item"
                        onclick="setActiveClass(this, 'drinks-snacks-games-images-shared-with-grid-nav-item', 'active'); showImages(activeEventId);">
                        <div class="drinks-snacks-games-images-shared-with-grid-nav-item-icon">
                            <i class="fa-solid fa-image"></i>
                        </div>
                        <p>Images</p>
                    </div>
                    <div class="drinks-snacks-games-images-shared-with-grid-nav-item"
                        onclick="setActiveClass(this, 'drinks-snacks-games-images-shared-with-grid-nav-item', 'active'); showShared(activeEventId);">
                        <div class="drinks-snacks-games-images-shared-with-grid-nav-item-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <p>Shared</p>
                    </div>
                </div>
                <div id="drinks-snacks-games-images-shared-with-content">
                </div>
            </div>
        </div>
    </div>

    <div id="add-event-slider">
        <div id="add-event-slider-header">
            <div id="close-add-event-icon" class="liquidGlass-wrapper" onclick="closeAddEventSlider()">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <i class="fa-solid fa-angle-left"></i>
            </div>

            <h2>Create New Event</h2>

            <div></div>
        </div>

        <form id="add-event-form" action="../../api/event-api.php" method="POST" enctype="multipart/form-data">
            <div class="add-event-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="add-event-section-header">
                    <div class="add-event-section-icon">
                        <i class="fa-solid fa-martini-glass-citrus"></i>
                    </div>
                    <p>Basic Information</p>
                </div>

                <div class="form-group">
                    <label for="event-name">Event Name *</label>
                    <input type="text" id="event-name" name="name" placeholder="Enter event name" required>
                </div>

                <div class="form-group">
                    <label for="event-description">Description *</label>
                    <textarea id="event-description" name="description" placeholder="Enter event description" required
                        rows="4"></textarea>
                </div>
            </div>

            <div class="add-event-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="add-event-section-header">
                    <div class="add-event-section-icon">
                        <i class="fa-regular fa-calendar-days"></i>
                    </div>
                    <p>Date & Time</p>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="event-start-date">Start Date *</label>
                        <input type="datetime-local" id="event-start-date" name="startDate" required>
                    </div>

                    <div class="form-group">
                        <label for="event-end-date">End Date *</label>
                        <input type="datetime-local" id="event-end-date" name="endDate" required>
                    </div>
                </div>
            </div>

            <div class="add-event-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="add-event-section-header">
                    <div class="add-event-section-icon">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <p>Event Details</p>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="event-dress-code">Dress Code</label>
                        <input type="text" id="event-dress-code" name="dresscode" placeholder="e.g. Casual, Formal">
                    </div>

                    <div class="form-group">
                        <label for="event-ranking">Ranking (1-5) *</label>
                        <input type="number" id="event-ranking" name="ranking" min="1" max="5" placeholder="5" required>
                    </div>
                </div>
            </div>

            <div class="add-event-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="add-event-section-header">
                    <div class="add-event-section-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <p>Location</p>
                </div>

                <div class="form-group">
                    <label for="event-location">Location *</label>
                    <div id="event-location-select-add">
                        <div id="event-location" class="event-location-select" onclick="openLocationSelect()">
                            Select location
                        </div>
                        <div id="add-location-button" class="liquidGlass-wrapper" onclick="openAddLocation()">
                            <div class="liquidGlass-effect"></div>
                            <div class="liquidGlass-tint"></div>
                            <div class="liquidGlass-shine"></div>

                            <div id="add-location-button-icon">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="event-location-id" name="locationId" value="">
                </div>
            </div>

            <div class="add-event-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="add-event-section-header" id="add-event-share-with-header">
                    <div class="add-event-section-header-left">
                        <div class="add-event-section-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <p>Share Event With</p>
                    </div>
                    <div id="add-event-shared-with-counter">
                        0
                    </div>
                </div>
                <div id="add-event-share-with-content">
                    <input type="text" id="add-event-share-with-search" placeholder="Search friends to share with ..."
                        oninput="searchFriendsToShareWith()">
                    <input type="hidden" id="event-shared-with-hidden" name="sharedWith" value="[]">

                    <div id="add-event-share-with-search-results">

                    </div>
                </div>
            </div>

            <div class="add-event-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="add-event-section-header" id="add-event-snacks-header">
                    <div class="add-event-section-icon">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <p>Snacks</p>
                </div>
                <div id="add-event-snacks-content">
                    <input type="text" id="add-event-snacks-search" placeholder="Search snacks to add ..."
                        oninput="searchSnacks()">
                    <input type="hidden" id="event-snacks-hidden" name="snacks" value="[]">

                    <div id="add-event-snacks-search-results">

                    </div>
                </div>
            </div>

            <div class="add-event-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="add-event-section-header" id="add-event-drinks-header">
                    <div class="add-event-section-icon">
                        <i class="fa-solid fa-glass-water"></i>
                    </div>
                    <p>Drinks</p>
                </div>
                <div id="add-event-drinks-content">
                    <input type="text" id="add-event-drinks-search" placeholder="Search drinks to add ..."
                        oninput="searchDrinks()">
                    <input type="hidden" id="event-drinks-hidden" name="drinks" value="[]">

                    <div id="add-event-drinks-search-results">

                    </div>
                </div>
            </div>

            <div class="add-event-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="add-event-section-header" id="add-event-games-header">
                    <div class="add-event-section-icon">
                        <i class="fa-solid fa-dice"></i>
                    </div>
                    <p>Games</p>
                </div>
                <div id="add-event-games-content">
                    <input type="text" id="add-event-games-search" placeholder="Search games to add ..."
                        oninput="searchGames()">
                    <input type="hidden" id="event-games-hidden" name="games" value="[]">

                    <div id="add-event-games-search-results">

                    </div>
                </div>
            </div>

            <div class="add-event-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="add-event-section-header">
                    <div class="add-event-section-icon">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    <p>Images</p>
                </div>
                <div class="form-group">
                    <label for="event-images">Upload Images</label>
                    <input type="file" id="event-images" name="event-images[]" accept="image/*" multiple >
                    <div id="event-images-preview" class="images-preview">

                    </div>
                </div>
                
            </div>

            <div class="add-event-form-section liquidGlass-wrapper">
                <div class="liquidGlass-effect"></div>
                <div class="liquidGlass-tint"></div>
                <div class="liquidGlass-shine"></div>

                <div class="add-event-section-header">
                    <div class="add-event-section-icon">
                        <i class="fa-regular fa-image"></i>
                    </div>
                    <p>Cover Image</p>
                </div>
                <div class="form-group">
                    <label for="event-cover-images">Upload an image which will be displayed as the event cover</label>
                    <input type="file" id="event-cover-image" name="event-cover-image" accept="image/*" >
                </div>
                
            </div>


            <div class="form-actions">
                <div class="btn-cancel liquidGlass-wrapper" onclick="closeAddEventSlider()">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <span>Cancel</span>
                </div>

                <input type="submit" class="btn-submit" value="Create Event" name="add-event">
            </div>
        </form>
    </div>

    <div id="add-location-slider">
        <div id="add-location-inner">
            <div id="add-location-header">
                <div id="close-add-location-icon" class="liquidGlass-wrapper" onclick="closeAddLocation()">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <i class="fa-solid fa-angle-left"></i>
                </div>

                <div>
                    <h2>Add Location</h2>

                    <p>Note: Everyone can view the location information.</p>
                </div>
            </div>
            <form action="../../api/location-api.php" method="POST" id="add-location-form">
                <div class="form-group">
                    <label for="location-name">Location Name *</label>
                    <input type="text" id="location-name" name="name" placeholder="Enter location name" required>
                </div>

                <div class="form-group">
                    <label for="location-description">Description</label>
                    <textarea id="location-description" name="description" placeholder="Enter location description"
                        rows="4"></textarea>
                </div>

                <input name="add-location" type="submit" id="add-location-submit" value="Add Location">
            </form>
        </div>
    </div>

    <div id="select-location-slider">
        <div id="select-location-header">
            <div id="close-select-location-icon" onclick="closeLocationSelect()">
                <i class="fa-solid fa-angle-left"></i>
            </div>

            <h2>Select Location</h2>
        </div>
        <div id="select-location-inner">

            <input type="text" id="search-location" placeholder="Search ..." oninput="searchLocation()">

            <hr class="location-search-seperator">

            <div id="search-location-results">

            </div>
        </div>
    </div>
</body>

</html>