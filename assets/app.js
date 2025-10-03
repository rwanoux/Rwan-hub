import './bootstrap.js';
import './vendor/axentix/dist/axentix.min.css';
import * as Axentix from './vendor/axentix/axentix.index.js';
import { is_touch_device } from './modules/mobileTouch.js';
import { MouseFollower } from './modules/MouseFollower.js';
import { ThemeManager } from './modules/ThemeManager.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';




const initApp = () => {
    new ThemeManager();
    Axentix.destroyAll();
    if (!is_touch_device()) {
        new MouseFollower();

    } else {
        document.querySelector('.overlay').style.display = 'none';
    }
    window.axentix = null;

    // Ensure Sidenav can't trigger a duplicate-instance error, then init all components
    const sidenavEl = document.querySelector('#main-sidenav');
    if (sidenavEl) {
        const existingSidenav = Axentix.getInstance(sidenavEl);
        if (existingSidenav) {
            existingSidenav.destroy();
        }
    }
    new Axentix.Axentix('all');

};
document.addEventListener('turbo:load', () => {

    console.log("turbo loaded");
    try {
        initApp();
    } catch (e) {
        console.log(e);
    }
});