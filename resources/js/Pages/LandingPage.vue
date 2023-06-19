<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
const props = defineProps({
    comics: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <body>
        <div class="content">
            <header>
                <div class="logo">
                    <div id="logo__webLogo">
                        <img src="../../assets/logoLanding.svg" alt="logo" />
                    </div>
                    <span id="logo__webTitle">DizManga</span>
                </div>
                <div class="login-buttons">
                    <Link
                        :href="route('login')"
                        class="login-buttons__log"
                        as="button"
                    >
                        Login
                    </Link>
                    <Link
                        :href="route('register')"
                        class="login-buttons__reg"
                        as="button"
                    >
                        Register
                    </Link>
                </div>
            </header>
            <section class="welcome-section">
                <div class="welcome-section__background">
                    <div id="left-side">
                        <img
                            src="../../assets/logoLanding.svg"
                            alt="logo"
                            id="welcome-logo__custom"
                        />
                        <h1 id="welcome-text__title">Dizmanga</h1>
                    </div>
                    <div id="right-side">
                        <h1 id="welcome-text__title">
                            Dive into a World of Comics, Manhwas, and Manga: All
                            in One Place!
                        </h1>
                        <p id="welcome-text">
                            Explore a world of comics, manhwas, and manga at
                            your fingertips. Dive into captivating stories, epic
                            adventures, and unforgettable characters.
                        </p>
                        <div class="wrapper">
                            <Link class="cta" :href="route('home')">
                                <span> EXPLORE!!</span>
                                <span>
                                    <svg
                                        width="44px"
                                        height="28px"
                                        viewBox="0 0 66 43"
                                        version="1.1"
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                    >
                                        <g
                                            id="arrow"
                                            stroke="none"
                                            stroke-width="1"
                                            fill="none"
                                            fill-rule="evenodd"
                                        >
                                            <path
                                                class="one"
                                                d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                                fill="#FFFFFF"
                                            ></path>
                                            <path
                                                class="two"
                                                d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                                fill="#FFFFFF"
                                            ></path>
                                            <path
                                                class="three"
                                                d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                                fill="#FFFFFF"
                                            ></path>
                                        </g>
                                    </svg>
                                </span>
                            </Link>
                        </div>
                    </div>
                </div>
            </section>
            <div id="first-view">
                <section class="slider-section">
                    <ul class="img-slider">
                        <li
                            class="img-slider__container"
                            v-for="comic in comics"
                        >
                            <img
                                :src="comic.img"
                                alt="img"
                                class="img-slider__pictures"
                            />
                        </li>
                        <li
                            class="img-slider__container"
                            v-for="comic in comics"
                        >
                            <img
                                :src="comic.img"
                                alt="img"
                                class="img-slider__pictures"
                            />
                        </li>
                        <li
                            class="img-slider__container"
                            v-for="comic in comics"
                        >
                            <img
                                :src="comic.img"
                                alt="img"
                                class="img-slider__pictures"
                            />
                        </li>
                    </ul>
                </section>
                <a id="see-more" href="#second-view">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="#000"
                    >
                        <path
                            d="m18.707 12.707-1.414-1.414L13 15.586V6h-2v9.586l-4.293-4.293-1.414 1.414L12 19.414z"
                        ></path>
                    </svg>
                </a>
            </div>
        </div>
        <section id="second-view">
            <video id="video-container" muted loop autoplay>
                <source src="../../assets/4KVAGABOND.webm " type="video/webm" />
                <source src="../../assets/4KVAGABOND.mp4 " type="video/mp4" />
            </video>
            <div class="banner">
                <span class="banner__text"> Mangas, Comics and MORE!! </span>
            </div>
            <div class="banner-img">
                <img src="../../assets/manhwa.webp" alt="manhwa" id="img" />
                <img src="../../assets/whiteKnight.webp" alt="comic" id="img" />
                <img src="../../assets/vinland.webp" alt="manga" id="img" />
            </div>
            <div class="go-back">
                <a id="see-more" href="#first-view">
                    <span id="see-more__text">See more </span>
                    <svg
                        fill="#000000"
                        height="24px"
                        width="24px"
                        version="1.1"
                        id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 330 330"
                        xml:space="preserve"
                    >
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g
                            id="SVGRepo_tracerCarrier"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                id="XMLID_224_"
                                d="M325.606,229.393l-150.004-150C172.79,76.58,168.974,75,164.996,75c-3.979,0-7.794,1.581-10.607,4.394 l-149.996,150c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.857,15.355,5.858,21.213,0l139.39-139.393l139.397,139.393 C307.322,253.536,311.161,255,315,255c3.839,0,7.678-1.464,10.607-4.394C331.464,244.748,331.464,235.251,325.606,229.393z"
                            ></path>
                        </g>
                    </svg>
                </a>
            </div>
        </section>
    </body>
</template>

<style scoped>
@import "../../css/main.scss";
</style>
