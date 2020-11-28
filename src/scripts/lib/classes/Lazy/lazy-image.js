import InViewport from 'in-viewport';

export default class LazyImage {
  constructor(imageElement) {
    this.el = imageElement;
    this.src = imageElement.getAttribute('data-lazy-src');

    this.watcher = InViewport(this.el, { debounce: 300 }, () => {
      this.load();
      this.dispose();
    });
  }

  load() {
    this.el.src = this.src;
  }

  dispose() {
    this.watcher.dispose();

    this.el = null;
    this.watcher = null;
  }
}
