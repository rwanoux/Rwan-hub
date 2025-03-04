import { Timeline } from 'vis-timeline';

export class FormationsTimeline {
    constructor() {
        this.init();
    }

    init() {
        const container = document.getElementById('timeline');
        const items = new DataSet(this.formatData());

        const options = {
            height: '400px',
            locale: 'fr',
            cluster: true,
            stack: false,
            showMajorLabels: true,
            showCurrentTime: false,
            zoomable: true
        };

        this.timeline = new Timeline(container, items, options);
    }
}