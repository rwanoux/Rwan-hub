import './bootstrap.js';
import { MouseFollower } from './modules/MouseFollower.js';
import { ThemeManager } from './modules/ThemeManager.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// Initialisation
window.addEventListener('load', () => {
    //mouse follower animation to enlight the pages
    new MouseFollower();
    //light/dark mode
    new ThemeManager();


});