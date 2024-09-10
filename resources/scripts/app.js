import domReady from '@roots/sage/client/dom-ready';
import Cards from './cards';
import LoadMoreOffers from './loadMoreOffers';

/**
 * Application entrypoint
 */
domReady(async () => {
  new Cards('.tabs');

  document.querySelectorAll('.load-more-offers').forEach((el) => {
    new LoadMoreOffers(el);
  })
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
