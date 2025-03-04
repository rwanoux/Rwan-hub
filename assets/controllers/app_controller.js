import { Controller } from '@hotwired/stimulus';
import { ThemeManager } from '../modules/ThemeManager.js';
import { MouseFollower } from '../modules/MouseFollower.js';
import * as Axentix from '../vendor/axentix/axentix.index.js';
import { is_touch_device } from '../modules/mobileTouch.js';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        console.log('init !!!!!!!!!!!!!')
    }

}
