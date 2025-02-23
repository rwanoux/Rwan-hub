import { is_touch_device } from "./mobileTouch.js";
export class MouseFollower {
    constructor() {

        this.init();
    }

    init() {
        if (window.mouseFollowerInstance) {
            return window.mouseFollowerInstance;
        }

        this.lighter = document.querySelector('.lighter');
        this.mouse = { x: 0, y: 0 };
        this.current = { x: 0, y: 0, w: 100, h: 100 };
        this.lerp = 0.5;

        this.bindEvents();
        this.animate();

        window.mouseFollowerInstance = this;
    }

    bindEvents() {
        if (is_touch_device()) {
            // Gestionnaire de mouvement de souris
            document.addEventListener('pointermove', (e) => {
                this.mouse.x = e.clientX;
                this.mouse.y = e.clientY;
            });


            document.addEventListener('pointerdown', (e) => {
                this.handleClick(e);
            });
        } else {
            // Gestionnaire de mouvement de souris
            document.addEventListener('mousemove', (e) => {
                this.mouse.x = e.clientX;
                this.mouse.y = e.clientY;
            });

            document.addEventListener('click', (e) => {
                this.handleClick(e);
            });
        }
        // Gestionnaire pour Turbo ou autres systèmes de navigation
        document.addEventListener('turbo:load', () => {
            this.lighter = document.querySelector('.lighter');
        });

        // Fallback pour les navigations classiques
        window.addEventListener('DOMContentLoaded', () => {
            this.lighter = document.querySelector('.lighter');

        });
    }

    handleClick(e) {

        if (this.lighter) {
            console.log('Handling link click');
            this.lighter.classList.add('clicked');

            // Retirer la classe après l'animation
            setTimeout(() => {
                this.lighter.classList.remove('clicked');
            }, 400);
        }
    }
    animate() {
        // Calcul du lerp
        this.current.x += (this.mouse.x - this.current.x - this.lighter.offsetWidth / 2) * this.lerp;
        this.current.y += (this.mouse.y - this.current.y - this.lighter.offsetHeight / 2) * this.lerp;

        // Application de la position        this.lighter.style.transform = `translate(${this.current.x}px, ${this.current.y}px)`;
        this.lighter.style.transform = `translate(${this.current.x}px, ${this.current.y}px)`;


        requestAnimationFrame(() => this.animate());
    }
}