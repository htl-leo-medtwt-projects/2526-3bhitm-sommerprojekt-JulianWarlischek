/**
 * @author Julian Warlischek
 * @description This is the main script for the project. It initializes the application and handles user interactions.
 */

let previousNode = 0;


function slideTo(anchorPosition) {
    const targetElement = document.getElementById(anchorPosition);

    let currentNode = getPathNode(anchorPosition);

    fadeOut()
    previousNode = currentNode;
}

function getPathNode(anchorPosition) {
    if (anchorPosition === "home-landing-section") {
        return 0;
    } else {
        return parseInt(anchorPosition.split("-")[2]);
    }
}

function fadeOut(element, duration) {
    element.style.transition = `opacity ${duration}ms ease-in-out`;
    element.style.opacity = 0;

    setTimeout(() => {
        element.style.transition = "none";
    }, duration);
}

function fadeIn(element, duration) {
    element.style.transition = `opacity ${duration}ms ease-in-out`;
    element.style.opacity = 1;

    setTimeout(() => {
        element.style.transition = "none";
    }, duration);
}

const onboardingTour = {
    pathSystem: {
        id: "onboarding-tour",
        title: "AfterMemory App Tour",
        description: "A clickable journey through the most important app features.",
        version: "1.1.0",
        allowLinearNavigation: true,
        allowBackNavigation: true,
        startStepId: "step-home",
        progressStyle: {
            showPathLine: true,
            pathLineColor: "#9AA4B2",
            completedColor: "#2A9D8F",
            currentColor: "#E76F51",
            lockedColor: "#C9CED6"
        }
    },
    steps: [
        {
            id: "step-home",
            order: 1,
            headline: "Welcome to AfterMemory",
            description: "This is your home screen and main navigation starting point.",
            backgroundInformation: "From here, users quickly access events, friends, and profile settings.",
            badge: "./images/badges/one-badge.png",
            route: {
                page: "index.html",
                anchor: "home-landing-section"
            },
            navigation: {
                previousStepId: null,
                nextStepId: "step-events"
            },
            style: {
                theme: "sunrise",
                accentColor: "#E76F51",
                cardBackground: "linear-gradient(135deg, #FFF1E6 0%, #FFD9C2 100%)",
                badgeShape: "circle",
                icon: "fa-house",
                layout: {
                    container: {
                        position: "relative",
                        minHeight: "520px"
                    },
                    headline: {
                        position: "absolute",
                        top: "8%",
                        left: "8%",
                        maxWidth: "48%"
                    },
                    description: {
                        position: "absolute",
                        top: "26%",
                        left: "10%",
                        maxWidth: "44%"
                    },
                    backgroundInformation: {
                        position: "absolute",
                        bottom: "12%",
                        left: "8%",
                        maxWidth: "38%"
                    },
                    badge: {
                        position: "absolute",
                        top: "14%",
                        right: "10%"
                    },
                    controls: {
                        position: "absolute",
                        bottom: "8%",
                        right: "8%"
                    }
                }
            }
        },
        {
            id: "step-events",
            order: 2,
            headline: "Discover Events",
            description: "Browse upcoming events and apply quick filters by time range.",
            backgroundInformation: "Events are where users plan moments and create future memories.",
            badge: "./images/badges/two-badge.png",
            route: {
                page: "pages/events.php",
                anchor: "main-content"
            },
            navigation: {
                previousStepId: "step-home",
                nextStepId: "step-friends"
            },
            style: {
                theme: "ocean",
                accentColor: "#118AB2",
                cardBackground: "linear-gradient(135deg, #E0F2FF 0%, #BDE3FF 100%)",
                badgeShape: "hexagon",
                icon: "fa-martini-glass-citrus",
                layout: {
                    container: {
                        position: "relative",
                        minHeight: "520px"
                    },
                    headline: {
                        position: "absolute",
                        top: "12%",
                        right: "9%",
                        maxWidth: "42%"
                    },
                    description: {
                        position: "absolute",
                        top: "34%",
                        right: "11%",
                        maxWidth: "40%"
                    },
                    backgroundInformation: {
                        position: "absolute",
                        bottom: "10%",
                        left: "9%",
                        maxWidth: "46%"
                    },
                    badge: {
                        position: "absolute",
                        top: "9%",
                        left: "8%"
                    },
                    controls: {
                        position: "absolute",
                        bottom: "7%",
                        right: "8%"
                    }
                }
            }
        },
        {
            id: "step-friends",
            order: 3,
            headline: "Manage Friends",
            description: "See friend lists, requests, and social groups in one place.",
            backgroundInformation: "The social area helps users connect and share activity across the app.",
            badge: "./images/badges/three-badge.png",
            route: {
                page: "pages/friends.php",
                anchor: "friends-main-section"
            },
            navigation: {
                previousStepId: "step-events",
                nextStepId: "step-profile"
            },
            style: {
                theme: "mint",
                accentColor: "#2A9D8F",
                cardBackground: "linear-gradient(135deg, #E7FFF7 0%, #C8F5E7 100%)",
                badgeShape: "rounded-square",
                icon: "fa-user-group",
                layout: {
                    container: {
                        position: "relative",
                        minHeight: "520px"
                    },
                    headline: {
                        position: "absolute",
                        top: "10%",
                        left: "50%",
                        transform: "translateX(-50%)",
                        maxWidth: "60%",
                        textAlign: "center"
                    },
                    description: {
                        position: "absolute",
                        top: "30%",
                        left: "12%",
                        maxWidth: "35%"
                    },
                    backgroundInformation: {
                        position: "absolute",
                        top: "30%",
                        right: "10%",
                        maxWidth: "35%"
                    },
                    badge: {
                        position: "absolute",
                        bottom: "16%",
                        left: "14%"
                    },
                    controls: {
                        position: "absolute",
                        bottom: "8%",
                        right: "8%"
                    }
                }
            }
        },
        {
            id: "step-profile",
            order: 4,
            headline: "Personalize Your Profile",
            description: "Edit personal settings, manage gallery content, and tune privacy options.",
            backgroundInformation: "The profile is the personal control center for identity and customization.",
            badge: "./images/badges/four-badge.png",
            route: {
                page: "pages/profile.php",
                anchor: "profile-flex"
            },
            navigation: {
                previousStepId: "step-friends",
                nextStepId: "step-finish"
            },
            style: {
                theme: "rose",
                accentColor: "#D1495B",
                cardBackground: "linear-gradient(135deg, #FFE8EF 0%, #FFD1DD 100%)",
                badgeShape: "diamond",
                icon: "fa-user",
                layout: {
                    container: {
                        position: "relative",
                        minHeight: "520px"
                    },
                    headline: {
                        position: "absolute",
                        top: "9%",
                        left: "7%",
                        maxWidth: "55%"
                    },
                    description: {
                        position: "absolute",
                        top: "28%",
                        left: "8%",
                        maxWidth: "34%"
                    },
                    backgroundInformation: {
                        position: "absolute",
                        top: "24%",
                        right: "8%",
                        maxWidth: "42%"
                    },
                    badge: {
                        position: "absolute",
                        bottom: "12%",
                        right: "11%"
                    },
                    controls: {
                        position: "absolute",
                        bottom: "8%",
                        left: "8%"
                    }
                }
            }
        },
        {
            id: "step-finish",
            order: 5,
            headline: "Tour Complete",
            description: "You now know the core areas. Start creating your first memory.",
            backgroundInformation: "This final step wraps up onboarding and encourages immediate action.",
            badge: "./images/badges/five-badge.png",
            route: {
                page: "index.html",
                anchor: "home-landing-section"
            },
            navigation: {
                previousStepId: "step-profile",
                nextStepId: null
            },
            style: {
                theme: "gold",
                accentColor: "#E9B949",
                cardBackground: "linear-gradient(135deg, #FFF8DB 0%, #FFE9A8 100%)",
                badgeShape: "star",
                icon: "fa-flag-checkered",
                layout: {
                    container: {
                        position: "relative",
                        minHeight: "520px"
                    },
                    headline: {
                        position: "absolute",
                        top: "18%",
                        left: "50%",
                        transform: "translateX(-50%)",
                        maxWidth: "58%",
                        textAlign: "center"
                    },
                    description: {
                        position: "absolute",
                        top: "39%",
                        left: "50%",
                        transform: "translateX(-50%)",
                        maxWidth: "48%",
                        textAlign: "center"
                    },
                    backgroundInformation: {
                        position: "absolute",
                        bottom: "14%",
                        left: "50%",
                        transform: "translateX(-50%)",
                        maxWidth: "44%",
                        textAlign: "center"
                    },
                    badge: {
                        position: "absolute",
                        top: "9%",
                        right: "9%"
                    },
                    controls: {
                        position: "absolute",
                        bottom: "7%",
                        right: "8%"
                    }
                }
            }
        }
    ]
};

let currentStepId = onboardingTour.pathSystem.startStepId;

renderTourProgress();
renderTourStep(currentStepId);

function getStepById(stepId) {
    return onboardingTour.steps.find(step => step.id === stepId);
}

/* COPILOT */
function styleObjectToString(styleObject) {
    if (!styleObject) return "";

    return Object.entries(styleObject)
        .map(([property, value]) => {
            const cssProperty = property.replace(/[A-Z]/g, match => `-${match.toLowerCase()}`);
            return `${cssProperty}: ${value}`;
        })
        .join("; ");
}

function renderTourProgress() {
    const progressContainer = document.getElementById("tour-progress");

    if (!progressContainer) return;

    progressContainer.innerHTML = "";

    onboardingTour.steps.forEach(step => {
        const progressItem = document.createElement("button");

        progressItem.classList.add("tour-progress-item");
        progressItem.dataset.stepId = step.id;
        progressItem.type = "button";

        progressItem.innerHTML = `
            <span class="tour-progress-dot">
                <i class="fa-solid ${step.style.icon}"></i>
            </span>
            <span class="tour-progress-label">${step.order}</span>
        `;

        progressItem.addEventListener("click", () => {
            currentStepId = step.id;
            renderTourStep(currentStepId);
            slideTo("#path-system");
        });

        progressContainer.appendChild(progressItem);
    });
}

function renderTourStep(stepId) {
    const step = getStepById(stepId);
    const stage = document.getElementById("tour-stage");

    if (!step || !stage) return;

    currentStepId = stepId;

    const headlineStyle = styleObjectToString(step.style.layout.headline);
    const descriptionStyle = styleObjectToString(step.style.layout.description);
    const backgroundInformationStyle = styleObjectToString(step.style.layout.backgroundInformation);
    const badgeStyle = styleObjectToString(step.style.layout.badge);
    const controlsStyle = styleObjectToString(step.style.layout.controls);

    stage.innerHTML = `
        <section 
            class="tour-card theme-${step.style.theme}" 
            style="background: ${step.style.cardBackground};"
        >
            <div class="tour-card-glow"></div>

            <div class="tour-step-number">
                Step ${step.order} / ${onboardingTour.steps.length}
            </div>

            <div class="tour-headline" style="${headlineStyle}">
                <div class="tour-icon-pill" style="background: ${step.style.accentColor};">
                    <i class="fa-solid ${step.style.icon}"></i>
                </div>
                <h2>${step.headline}</h2>
            </div>

            <p class="tour-description" style="${descriptionStyle}">
                ${step.description}
            </p>

            <p class="tour-background-information" style="${backgroundInformationStyle}">
                ${step.backgroundInformation}
            </p>

            <div 
                class="tour-badge tour-badge-${step.style.badgeShape}" 
                style="${badgeStyle}; border-color: ${step.style.accentColor};"
            >
                <img 
                    src="${step.badge}" 
                    alt="Step ${step.order} badge"
                    onerror="this.style.display='none'"
                >
                <i class="fa-solid ${step.style.icon}" style="color: ${step.style.accentColor};"></i>
            </div>

            <div class="tour-controls" style="${controlsStyle}">
                <button 
                    class="tour-button tour-button-secondary" 
                    type="button"
                    onclick="goToPreviousStep()"
                    ${!step.navigation.previousStepId ? "disabled" : ""}
                >
                    <i class="fa-solid fa-arrow-left"></i>
                    Zurück
                </button>

                <button 
                    class="tour-button tour-button-primary" 
                    type="button"
                    style="background: ${step.style.accentColor};"
                    onclick="goToNextStep()"
                >
                    ${step.navigation.nextStepId ? "Weiter" : "Fertig"}
                    <i class="fa-solid ${step.navigation.nextStepId ? "fa-arrow-right" : "fa-check"}"></i>
                </button>

                <button 
                    class="tour-button tour-button-dark" 
                    type="button"
                    onclick="openTourRoute('${step.route.page}', '${step.route.anchor}')"
                >
                    Seite öffnen
                    <i class="fa-solid fa-up-right-from-square"></i>
                </button>
            </div>
        </section>
    `;

    updateProgressState();
}

function updateProgressState() {
    const currentStep = getStepById(currentStepId);
    const progressItems = document.querySelectorAll(".tour-progress-item");

    if (!currentStep) return;

    progressItems.forEach(item => {
        const step = getStepById(item.dataset.stepId);

        item.classList.remove("completed", "current", "locked");

        if (step.order < currentStep.order) {
            item.classList.add("completed");
        } else if (step.order === currentStep.order) {
            item.classList.add("current");
        } else {
            item.classList.add("locked");
        }
    });
}

function goToPreviousStep() {
    const step = getStepById(currentStepId);

    if (!step || !step.navigation.previousStepId) return;

    renderTourStep(step.navigation.previousStepId);
}

function goToNextStep() {
    const step = getStepById(currentStepId);

    if (!step) return;

    if (!step.navigation.nextStepId) {
        slideTo("#home-landing-section");
        return;
    }

    renderTourStep(step.navigation.nextStepId);
}

function openTourRoute(page, anchor) {
    const cleanPage = page.replace("./", "");
    window.location.href = `./${cleanPage}#${anchor}`;
}

function slideTo(selector) {
    const target = document.querySelector(selector);

    if (!target) return;

    target.scrollIntoView({
        behavior: "smooth",
        block: "start"
    });
}