// a singleton has to be created on window load
//need Pico.css
//need a switch element with id="lightmode"


export class ThemeManager {
    constructor() {
        this.init();
    }

    init() {
        // Évite les doubles initialisations
        if (window.themeManagerInstance) {
            return window.themeManagerInstance;
        }

        this.storageKey = 'preferred-theme';
        this.initializeSwitch(); // Initialisation immédiate du switch
        this.bindEvents();
        this.applyTheme();

        window.themeManagerInstance = this;
    }
    initializeSwitch() {
        this.switchElement = document.getElementById('lightmode');
        if (this.switchElement) {
            this.switchElement.checked = localStorage.getItem(this.storageKey) === 'light';
            this.switchElement.addEventListener('change', () => {
                const newTheme = this.switchElement.checked ? 'light' : 'dark';
                this.switchElement.parentElement.dataset.tooltip = newTheme === 'light' ? 'darkmode' : 'lightmode';
                this.setTheme(newTheme);
            });
        }
    }
    bindEvents() {

        // Écouter les changements sur toutes les pages
        document.addEventListener('turbo:load', () => {
            this.initializeSwitch();
        });

        // Écouter les changements de préférence système
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem(this.storageKey)) {
                const newTheme = e.matches ? 'dark' : 'light';
                this.setTheme(newTheme);
                if (this.switchElement) {
                    this.switchElement.checked = !e.matches;
                }
            }
        });
    }

    applyTheme() {
        const savedTheme = localStorage.getItem(this.storageKey);
        if (savedTheme) {
            this.setTheme(savedTheme);
        } else {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            this.setTheme(prefersDark ? 'dark' : 'light');
        }
    }

    setTheme(theme) {
        document.documentElement.dataset.theme = theme;
        localStorage.setItem(this.storageKey, theme);
        if (this.switchElement) {
            this.switchElement.checked = theme === 'light';
        }
    }
}