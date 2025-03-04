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



new Axentix.Axentix('all');

const initApp = async () => {
    new ThemeManager();
    await Axentix.destroyAll();
    new Axentix.Axentix('all');
    if (!is_touch_device()) {
        new MouseFollower();

    } else {
        document.querySelector('.overlay').style.display = 'none';
    }
};
/*
document.addEventListener('DOMContentLoaded', () => {
    console.log("content loaded");
    initApp();
});
*/
document.addEventListener('turbo:load', async () => {

    console.log("turbo loaded");
    await initApp();
}); 