import $ from 'jquery';

class LoadMoreOffers {
    constructor(button) {
        this.$button = $(button);
        this.activePage = 1;
        this.init();
    }

    init() {
        this.$button.on('click', (event) => {
            const $button = $(event.currentTarget);
            const categoryId = this.$button.data('category');
            let page = this.$button.data('page');

            this.blockButton();
            this.loadMoreOffers(categoryId, page, $button);
        });
    }

    loadMoreOffers(categoryId, page, $button) {
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_offers',
                nonce: ajax_object.nonce,
                category_id: categoryId,
                page: page,
            },
            success: (response) => {
                if (response.success && response.data.offers.length > 0) {
                    this.$button.data('page', page + 1);
                    $button.before(response.data.offers.join(''));

                    if (++this.activePage >= response.data.total_pages) {
                        this.destroyButton();
                    } else {
                        this.unblockButton();
                    }

                } else {
                    this.destroyButton();
                    console.error(response.data);
                }
            },
            error: (status, error) => {
                this.destroyButton();
                console.error(status, error);
            }
        });
    }

    blockButton() {
        this.$button.prop('disabled', true);
    }

    unblockButton() {
        this.$button.prop('disabled', false);
    }

    destroyButton() {
        this.$button.remove();
    }
}

export default LoadMoreOffers;
