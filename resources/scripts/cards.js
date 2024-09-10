import $ from 'jquery';

class Cards {
    constructor(container) {
        this.$container = $(container);
        this.$tabButtons = this.$container.find('.tab-item');
        this.$tabPanes = this.$container.find('.tab-pane');

        this.init();
    }

    init() {
        this.$tabPanes.hide();
        this.$tabPanes.first().show();

        this.$tabButtons.first().addClass('active');

        this.$tabButtons.on('click', (event) => {
            const $button = $(event.currentTarget);
            const targetId = $button.data('target');

            this.$tabPanes.hide();
            this.$container.find(targetId).show();
            this.$tabButtons.removeClass('active');
            $button.addClass('active');
        });
    }
}

export default Cards;
